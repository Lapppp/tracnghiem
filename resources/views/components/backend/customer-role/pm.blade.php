<ul class="list-group border-0">
    <li class="list-group-item border-0">

        <input class="form-check-input"  name="account_settings[1][parent]" type="checkbox" value="parent_1" id="flexCheckDefault" aria-label="...">
        First checkbox

        <ul class="list-group border-0 mt-2 ms-5">
            <li class="list-group-item border-0">

                <input class="form-check-input"  name="account_settings[1][children][]" type="checkbox" value="children_one" aria-label="..." id="flexCheckDefault">
                sss
            </li>
            <li class="list-group-item border-0">
                <input class="form-check-input widget-9-check" name="account_settings[1][children][]" type="checkbox" value="children_two" aria-label="...">
                First checkbox
            </li>
        </ul>
    </li>
    <li class="list-group-item border-0">
        <input class="form-check-input me-1" type="checkbox" value="parent_2"  name="account_settings[2][parent]" aria-label="...">
        First checkbox
        <ul class="list-group border-0 mt-2 ms-5">
            <li class="list-group-item border-0">
                <input class="form-check-input widget-9-check"  name="account_settings[2][children][]" type="checkbox" value="children_one" aria-label="..." id="flexCheckDefault">

                First checkbox


            </li>
            <li class="list-group-item border-0">
                <input class="form-check-input widget-9-check" name="account_settings[2][children][]" type="checkbox" value="children_two" aria-label="...">
                First checkbox
            </li>
        </ul>
    </li>

</ul>

<x-slot name="javascript">
    <script type="text/javascript">
        $(document).ready(function() {


            $('input[type=checkbox]').click(function () {
                $(this).parent().find('li input[type=checkbox]').prop('checked', $(this).is(':checked'));
                var sibs = false;
                $(this).closest('ul').children('li').each(function () {
                    if($('input[type=checkbox]', this).is(':checked')) sibs = true;
                })
                $(this).parents('ul').prev().prop('checked', sibs);
            });


            $('[name="birthday"]').flatpickr({
                dateFormat: "d-m-Y",
            });
            $(document).on('click', '#status', function(){

                if ($(this).is(":checked")) {
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }
            });


        });
    </script>
</x-slot>
