<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Api Test</title>
    </head>
    <body>
        <div class="container">
          <div class="row">
            <div class="col-12"><h1>Class Test</h1></div>

            <div class="col-12 border">

                <form action="upload" method="post" class="pb-3" id="form" enctype="application/x-www-form-urlencoded">
                  <div class="mb-3">
                    <label for="phone_number" class="form-label">Add phone number (required)</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                  </div>
                  <div class="mb-3">
                    <label for="phone_country" class="form-label">Add phone country (required)</label>
                    <select class="form-select" id="phone_country" name="phone_country" required>
                      <option selected disabled value="">Выберите...</option>
                      <?php foreach ((new PhoneCheck())->getCountryNames() as $item) { ?>
                        <option><?=$item?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <span id="message"></span>
                </form>

            </div>

            <div class="col-12 border mt-3">

              <form action="info" method="post" class="pb-3" id="form-search" enctype="application/x-www-form-urlencoded">
                  <div class="mb-3">
                      <label for="phone_number_search" class="form-label">Search phone number (required)</label>
                      <input type="text" class="form-control phone_number_search" id="phone_number_search" name="phone_number_search" required>
                      <div id="for-search-result" class="for-search-result"></div>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <span id="message_search"></span>
              </form>

            </div>

            <div class="col-12 border mt-3">

              <form action="delete" method="post" class="pb-3" id="form-del" enctype="application/x-www-form-urlencoded">
                  <div class="mb-3">
                      <label for="phone_number_del" class="form-label">Delete phone number</label>
                      <input type="text" class="form-control phone_number_search" id="phone_number_del" name="phone_number_del" data-id="" required>
                      <div id="for-delete-result" class="for-search-result"></div>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <span id="message_del"></span>
              </form>

            </div>

          </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="/js/scripts.js"></script>
    </body>
</html>