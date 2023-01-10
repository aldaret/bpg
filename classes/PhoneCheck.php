<?php

class PhoneCheck
{
    protected string $phone;

    protected string $countryName;

    protected array $codes;

    public function __construct()
    {
        $this->codes = json_decode(COUNTRY_CODES, true);
    }

    public function setPhoneNumber(string $phone, string $countryName): array
    {
        $this->phone = $phone;
        $this->countryName = $countryName;

        $this->clearPhone();

        if (false === $this->checkAlphabet()) {
            return [
                'status' => 'error',
                'message' => 'Number incorrect: invalid characters!'
            ];
        }

        if (false === $this->checkPhoneCodeByCountryName()) {
            return [
                'status' => 'error',
                'message' => 'Number incorrect: country code does not match with country name!'
            ];
        }

        if (false === $this->checkMask()) {
            return [
                'status' => 'error',
                'message' => 'Number incorrect: the number must start with + !'
            ];
        }

        return [
            'status' => 'success',
            'message' => [
                'phone' => $this->phone,
                'country_code' => $this->getCountryCode(),
                'country_name' => $this->countryName
            ]
        ];
    }

    private function clearPhone(): void
    {
        $this->phone = str_ireplace(' ', '', $this->phone);
        $this->phone = str_ireplace('-', '', $this->phone);

        if(substr_compare($this->phone, '00', 0, 2, true) == 0){
            $this->phone = substr_replace($this->phone, '+',  0, 2);
        }

        if (
            ($this->getCountryCode() == 'RO' && in_array(substr($this->phone, 0, 2), ['02', '03', '07'])) ||
            ($this->getCountryCode() == 'DE' && in_array(substr($this->phone, 0, 2), ['01', '03', '04', '05', '06', '08', '09']))
        ){
            $this->phone = '+' . $this->phone;
        }

        $this->phone = str_ireplace('++', '+', $this->phone);
    }

    private function checkAlphabet(): bool
    {
        return preg_match("#^[0-9\-\+ ]+$#", $this->phone) && !ctype_space($this->phone);
    }

    private function checkMask(): bool
    {
        return str_starts_with($this->phone, '+');
    }

    private function getCountryCode()
    {
        return $this->codes[array_search($this->getPhoneCode(), array_column($this->codes, 'dial_code'))]['code'];
    }

    private function getPhoneCode()
    {
        return $this->codes[array_search($this->countryName, array_column($this->codes, 'name'))]['dial_code'];
    }

    public function checkPhoneCodeByCountryName(): bool
    {
        $phoneCode = str_ireplace(' ', '', $this->getPhoneCode());
        if (
            ($this->getCountryCode() == 'RO' && in_array(substr($this->phone, 1, 2), ['02', '03', '07'])) ||
            ($this->getCountryCode() == 'DE' && in_array(substr($this->phone, 1, 2), ['01', '03', '04', '05', '06', '08', '09']))
        ){
            return true;
        }
        return substr_compare($this->phone, $phoneCode, 0, strlen($phoneCode), true) == 0;
    }

    public function getCountryNames(): array
    {
        return array_column($this->codes, 'name');
    }
}