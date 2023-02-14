<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.0.0-beta3/css/all.min.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/all.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/fontawesome6.min.css"> -->
    <!-- <link href="<?= base_url() ?>assets/css/fontawesome6.min.css" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="./css/all.css"> -->
    <!-- <style type="text/css">
        .popover {
            max-width: 50%;
        }
    </style> -->
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="assets/js/icon-picker.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', init);

        function init() {
            iconPicker = new Fa6IconPicker({
                title: 'List Icon',
                targetInput: document.querySelector('input[name=icon_input]'),

                targetViewIcon: document.getElementById('view_icon'),
            });
        }
    </script>
</head>

<body>
    <div class="container m-3">
        <div class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-12">
                <input type="text" name="icon_input" class="form-control">
            </div>
            <div class="col-12">
                <button class="btn btn-primary" id="select_btn">Cari <i id="view_icon"></i></button>
            </div>
        </div>
    </div>
</body>

</html>