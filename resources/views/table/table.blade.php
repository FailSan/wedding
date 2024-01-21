<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __("Il Matrimonio di C&A") }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Scripts -->

    </head>
    <body>
        <div id="ajaxForm" class="vw-100 mx-auto my-auto border" style="height: 50vh;">
            <fieldset class="w-100 h-100 d-flex flex-row align-items-center">
                <div class="col col-md-6 p-5 justify-content-center">
                    <div class="form-floating w-50 my-2">
                        <input type="text" class="form-control" name="announcer_name" id="announcer_name" data-property="name">
                        <label for="announcer_name">Nome</label>
                    </div>
                    
                    <div class="form-floating w-50 my-2">
                        <input type="text" class="form-control" name="announcer_surname" id="announcer_surname" data-property="surname">
                        <label for="announcer_surname">Cognome</label>
                    </div>
                </div>

                <div class="col col-md-6 justify-content-center">
                    <button type="button" id="resetButton" class="btn btn-danger">Reset</button>
                    <button type="submit" id="searchButton" class="btn btn-primary">Cerca</button>
                </div>
            </fieldset>
        </div>

        <div id="ajaxTable" class="vw-50 vh-50 mx-auto my-auto border p-2 table-responsive">
            <table class="table table-hover m-0">
                <thead class="table-dark">
                    <tr>
                        <th data-property="id" scope="col">#</th>
                        <th data-property="name" scope="col">Name</th>
                        <th data-property="surname" scope="col">Surname</th>
                        <th scope="col">Modal</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>

            <nav class="my-2 d-flex justify-content-between">
                <ul id="pageIndexSelector" class="pagination m-0">
                </ul>

                <select id="pageSizeSelector" class="form-select form-select-sm w-auto">
                    <option value="2">2</option>
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                </select>
            </nav>

            <div id="detailModal"></div>
        </div>

        <script type="module">
            import { AjaxForm } from './scripts/tests/AjaxForm.js';
            import { AjaxTable } from './scripts/tests/AjaxTable.js';

            var csrfToken = document.querySelector("meta[name='csrf-token']").content;

            //Inizializzazione Elementi Obbligatori
            var tableContainer = document.querySelector("#ajaxTable");
            var pageIndexSelector = tableContainer.querySelector('#pageIndexSelector');
            var pageSizeSelector = tableContainer.querySelector('#pageSizeSelector');
            var targetTable = new AjaxTable(tableContainer, pageIndexSelector, pageSizeSelector);

            var formContainer = document.querySelector("#ajaxForm");
            var formUrl = "/guest/filter";
            var ajaxForm = new AjaxForm(formUrl, targetTable, csrfToken, false);

            targetTable.targetForm = ajaxForm;

            //Inizializzazione Elementi Opzionali
            var formInputs = formContainer.querySelectorAll("input");
            var formReset = formContainer.querySelector("#resetButton");
            var formSearch = formContainer.querySelector("#searchButton");

            ajaxForm.searchFields = formInputs;
            ajaxForm.resetButton = formReset;
            ajaxForm.searchButton = formSearch;

            ajaxForm.Search();
        </script>
    </body>
</html>