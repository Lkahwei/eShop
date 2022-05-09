    {{-- Grid System --}}
    {{-- 1. Firstly, create the largest div with the class "container" / "container-fluid" / "container.{breakpoint}" --}}
    {{-- 2. container is to set the predefined max-width for each breakpoint --}}
    {{-- 3. container-fluid is to set the width 100% for all breakpoints --}}
    {{-- 4. container-{breakpoint} is to set the width of 100% for the breakpoints below it --}}
    {{-- Row --}}
    {{-- 1. create the div with class "row" --}}
    {{-- 2. one row is being divided into 12 columns --}}
    {{-- 3. if the total number of column is more than 12, the column that exceeds the amount will be going into the next row without any gap --}}
    {{-- Col --}}
    {{-- 1. create the div with class "col" / "col-number" / "col-{breakpoint}-number" --}}
    {{-- 2. The col-{breakpoint}-number is applied to the this breakpoint and above only--}}
    {{-- Row-cols --}}
    {{-- 1. E.g row-cols-4 is each row will consists of 4 columns to the div with classname "row" --}}
    {{-- 2. row-cols-{breakpoint}-number will only applied to this breakpoint and above --}}
    {{-- offset --}}
    {{-- offset-{breakpoint} / offset-{breakpont}-{number} to add the offset to this breakpoint and above --}}

    {{-- Tables --}}
    {{-- 1. Add class "table" at the table tag --}}
    {{-- 2. if want to add table-primary, in table tag you must declare "table" class first, but in tr,th,td tag, just write table-primary --}}
    {{-- 3. table-striped in the table tag in addition to the "table" class to add in zebra lines --}}
    {{-- 4. table-hover in the table tag in addition to the "table" class to add the hover effects on tr within tbody --}}
    {{-- 5. table-active to add in active effect on tr/th/td --}}
    {{-- 6. table-bordered in table tag in addition to the "table" class to add the border --}}

    {{-- Cards --}}
    {{-- 1. Create the div with class name "card" --}}
    {{-- 2. Create the another div which is the container within the first div with class name "card-body" --}}
    {{-- 3. Create the another text tag h5/p/etc.. within the second div with the class name card-title --}}
    {{-- 4. card-subtitle class to create the subtitle --}}
    {{-- 5. card-text to add the text inside the "card-body" --}}
    {{-- 6. card-link to add the link --}}
    {{-- 7. card-img-top / card-img-bottom to the img tag --}}
    {{-- 8. card-header become the very first to create the header for the card --}}
    {{-- 9. card-footer to the footer of the card --}}
 
    {{-- Utilities --}}

    {{-- Background Color --}}
    {{-- 1. bg-primary / bg.danger stands for the background color --}}
    {{-- 2. bg-gradient in addition to the bg-primary etc.. to add the gradient effect--}}

    {{-- Border --}}
    {{-- 1. border / border-top / border-end / border-start / border-bottom to add border --}}
    {{-- 2. border-top-0 / etc.. to remove the border from top etc.. --}}
    {{-- 3. border-primary, border-secondary / border-1, border-2 to add in color, width in addition to the "border" class --}}
    {{-- 6. rounded / rounded-top / rounded-circle / rounded-pill to round the border--}}
    {{-- 7. rounded-0 / rounded-1 / rounded-2 to be more rounded --}}

    {{-- Text Color --}}
    {{-- 1. add text-primary, text-secondary class name etc.. --}}

    {{-- Display --}}
    {{-- 1. d- stands for display- --}}
    {{-- 2. d-inline class is for display inline (which means it will only occupy the space of the content only and another div with same class can print next to it) --}}
    {{-- 3. d-block class is for display as block which means it will occupy the whole line and the element next to it without being the child element of it will be printed next line --}}
    {{-- 4. d-none for display as a none --}}
    {{-- 4. d-inline-block class stands for inline-block which means that there will be some space between the element with this class and the next class (it has both the properties of inline and block)  --}}
    {{-- 5. d-{breakpoint}-{properties} is only applied to that breakpoint and above --}}

    {{-- Flex --}}
    {{-- 1. "d-flex" stands for flexbox container --}}
    {{-- 2. "d-inline-flex" stands for inline flexbox container --}}
    {{-- 3. "d-flex" or "d-inline-flex" must be added in order to use the following functionality of flexible container --}}
    {{-- All of these properties are only applied to the flexitem, not the container itself --}}
    {{-- if inline is applied, then the container would be started at the start of the browser (left of the browser) --}}
    {{-- 4. flex-row / flex-row-reverse stands for make the flex items to become in a row --}}
    {{-- 5. flex-column / flex-column-reverse stands for making the flex items to become in a column --}}
    {{-- 6. For Within a Row, within different columns: justify-content-start / justify-content-center / justify-content-end / justify-content-between / justify-content-around to justify the content position--}}
    {{-- 7. For within different rows, but within the columns: align-items-start / align-items-end / align-items-center / align-items-baseline / align-items-stretch (default by the browser) --}}
    {{-- 8. "flex-fill" is applied to the flex-item to make the content fill more space, else if no state, the container that wrap the content will be enough width for the content --}}
    {{-- 8. If we want to add breakpoint, make sure to write the d-breakpoint-properties, this will apply the properties to breakpoint and up breakpoints --}}
    {{-- 9. ms-auto stands for margin start - auto, me-auto, mb-auto, mt-auto will add margin (start, end, bottom, etc) to the respective div --}}
    {{-- 11. flex-grow-1 is same like flex fill --}}
    {{-- 12. flex-shrink-1 will shrink the content to only the space required --}}
    {{-- 13. Order-first will be first, order-0, no order class, order-{1-n} and order last to make the order --}}

    {{-- Float --}}
    {{-- 1. float-start to float to the start --}}
    {{-- 2. float-end to float to the end --}}
    {{-- 3. float-none to not float --}}
    {{-- 4. float-{breakpoint}-start / end / none to apply the float properties to this breakpoint and above --}}

    {{-- Interaction --}}
    {{-- 1. user-select-all will highlight / select all the text when is clicked --}}
    {{-- 2. user-select-auto : default browser behaviour --}}
    {{-- 3. user-select-none : is not selectable --}}

    {{-- Pointer Event --}}
    {{-- 1. pe-none : the link cannot be clicked inside the a tag --}}
    {{-- 2. pe-auto : default pointer behaviour --}}
    {{-- 3. if specified class in the parent, a tag will inherit it, else if the specified class is declared in a tag, it will use its own one --}}

    {{-- Overflow --}}
    {{-- 1. overflow-auto : default browser overflow behaviour --}}
    {{-- 2. overflow-hidden : will hide the result when the pixels is not enough --}}
    {{-- 3. overflow-visible :  --}}
    {{-- 4. overflow-scroll: will add vertical scroll bar and horizontal scroll bar --}}

    {{-- Position --}}
    {{-- 1. static: The default positioning behaviour of the webpage, it will position the element follow the normal flow of the webpage --}}
    {{-- 2. relative: The element is position relatively to its normal position --}}
    {{-- 3. fixed: The element will always stay in the webpage even though the webpage is scroll --}}
    {{-- 4. Absolute: The element will be placed to the specific absolute position and can overlap the elements under it --}}
    {{-- 5. sticky: The element will stick to the top or the bottom when the user scroll the webpage --}}
    {{-- position-attributes to apply the position attributes to the class --}}
    {{-- For position-absolute class --}}
    {{-- 1. top-0, start-0 : top left --}}
    {{-- 2. top-0, end-0 : top right --}}
    {{-- 3. top-50, start-50 : center top left --}}
    {{-- 4. bottom-50, end-50 : center bottom right --}}
    {{-- 5. bottom-0, start-0 : Bottom left --}}
    {{-- 6. bottom-0, end-0 : Bottom Right --}}
    {{-- Translate Middle (Position-absolute) --}}
    {{-- 1. Stands for translation middle --}}

    {{-- Width --}}
    {{-- 1. w-25 w-50 w-75 w-100 w-auto (by default) : stands for 25%, 50% and etc..  --}}
    {{-- 2. mw-25 mw-50 stands for maximum width --}}

    {{-- Height --}}
    {{-- 1. h-25 h-50 h-75 h-100 h-auto (by default): stands for 25%, 50% and etc..  --}}
    {{-- 2. mh-25 mh-50 stands for maximum height --}}

    {{-- Margin --}}
    {{-- 1. mt-n, mb-n, ms-n, me-n, mx-n, my-n, m-n, mx-auto / m-auto (this will horizontally center the element) --}}
    
    {{-- Padding --}}
    {{-- 1.  pt-n, pb-n, ps-n, pe-n, px-n, py-n, p-n  --}}
    {{-- 2. p-1 stands for padding of 4px, p-2 stands for 8px, p-3 stands for 16px, p-4 stands for 24px, etc...  --}}
    {{-- 3. When using display grid (not container), you can use gap-n to increase the gap between rows --}}

    {{-- Text --}}
    {{-- 1. text-start, text-center, text-end, text-{breakpoint}-start / end / center --}}
    {{-- Wrapping must in the condition that the width of the current container is not enough to cover all the words in one line --}}
    {{-- 2. text-wrap / text-nowrap (by default)--}}
    {{-- 3. text-lowercase / text-uppercase / text-capitalize to transfrom text --}}
    {{-- 4. fs-1, fs-2, fs-3 follow the sizing guide of h1, h2, h3 and it is for font size --}}
    {{-- 5. fw-bold, fw-bolder, fw-normal, fw-light, fw-lighter stands for font-weight --}}
    {{-- 6. lh-1, lh-sm, lh-base, lh-lg stands for line height (line spacing) --}}
    {{-- 7. text-primary, text-secondary, text-muted, etc.. for font color --}}
    {{-- 8. text-reset to reset the font color and inherit the color from its parent---}}
    {{-- 9. text-decoration-line-through, text-decoration-underline, text-decoration-none (to remove all the decoration) --}}
    {{-- 10. text alignment: align-baseline, align-top, align-middle / etc.. --}}
    {{-- 11. visible / invisible for visibility and invisibility --}}

    {{-- Colored Link --}}
    {{-- 1. link-success / link-primary / etc.. for coloured link --}}

    {{-- List --}}
    {{-- ul stands for unordered list , ol stands for ordered list --}}
    {{-- <pre> tag is for multiple lines of code --}}
    {{-- Use figure if you want to display an image with caption at the top or below it --}}
    {{-- img-fluid class to the image tag to make the image become responsive (max-width: 100% and height: auto) --}}
    {{-- h1, h2, h3, etc.. is the traditional one, if you wants the text to stand out, can use display-1, display-2 class which the sizing guide is same as h1, h2, h3 etc.. --}}
    {{-- lead class stands the p out of regular paragraph --}}

    {{-- aria-label is like the back up for the label tag --}}

    {{-- Form --}}
    {{-- form-label is to add to the label tag --}}
    {{-- form-control / form-control-lg / form-control-sm is to add to the input tag --}}
    {{-- form-select is added to the select tag--}}
    {{-- form-check-input is added to the input tag with checkbox /radio type --}}
    {{-- form-check-label is added to the label tag for checkbox / radio input --}}
    {{-- both of the above must be added to the div with form-check class --}}
    {{-- if you wants to switch the checkbox to switch, add two classes which are form-check and form-switch to the input with checkbox type  --}}

    {{-- Range --}}
    {{-- if you wants to create a range, use input type=range and add form-range class to the input tag --}}

    {{-- Button --}}
    {{-- 1. must add btn class to every button tag you want to apply the properties --}}
    {{-- 2. btn-primary, btn-sucess, etc.. for the color--}}
    {{-- 3. btn-outline-primary, btn-outline-success, etc.. to add the outline properties and the color..  --}}
    {{-- 4. btn-lg, btn-sm to add large and small --}}

    {{-- Button Group --}}
    {{-- 1. must add "btn-group" class to the container that stored all the buttons --}}
    {{-- 2. To make all button group as one toolbar, must add "btn-toolbar" to the container that store all the button groups --}}
    {{-- 3. btn-group-lg / btn-group-sm to make the large or small --}}
    {{-- 4. btn-group-vertical to make the btn group become vertical --}}

    {{-- Close Button --}}
    {{-- 1. add only the 'btn-close' to the button tag to style it--}}

    {{-- Alert --}}
    {{-- 1. must add "alert" class to the tag you wish to make it as an alert --}}
    {{-- 2. add alert-primary, alert-success, etc.. to add the color to this alert --}}
    {{-- 3. In order to add the link in the alert, must add the 'alert-link' class to the tag you wish to make it as a link --}}
    {{-- 4. "alert-heading" to make the text to become bigger and become the header inside the alert --}}
    {{-- 5. in order to use the button to close the alert, must add "data-bs-dismiss="alert"" to the button you wish to make it as the close button --}}

    {{-- Badge --}}
    {{-- 1. must add the "badge" class to the tag you wish to make it as a badge --}}

    {{-- Collapse --}}
    {{-- 1. add the 'collapse' class to the tag you wish to hide the content --}}
    {{-- 2. add the id that naming is on your choice which then is to be used at data-bs-target at the button --}}
    {{-- 3. make sure to add the data-bs-toggle = "collapse" to the button that toggle the collapse --}}
    {{-- 4. while toggleling multiple at once, change the id at data-bs-target to the class name that store the collapse items --}}

    {{-- Dropdown --}}
    {{-- 1. You need to wrap both the button that toggle the dropdown and also the content inside a big container with class "dropdown" --}}
    {{-- 2. Add the button that toggle the dropdown with data-bs-toggle="dropdown" and class name with an extra "dropdown-toggle" to create the icon with down arrow at the end of the button --}}
    {{-- 3. Add the list or either a big container with the classname="dropdown-menu" that store all the items --}}
    {{-- 4. Add the dropdown-item for each item inside the dropdown-menu to create the styling --}}
    {{-- 5. You can divide the dropdown item by adding a tag with classname "dropdown-divider" --}}
    {{-- 6. You can also create another button and split the dropdown function with the data-bs-toggle="dropdown" (it is the most important in order to create the dropdown function) --}}
    {{-- 7. You can create the non-clickable drop down item by replacing the dropdown-item the class name "dropdown-item-text"  --}}
    {{-- 8. dropdown-header class to make the header of the dropdown-items --}}

    {{-- List group --}}
    {{-- 1. the ul tag is with the class name 'list-group' --}}
    {{-- 2. the li tag is with the class name 'list-group-item' --}}
    {{-- 3. list-group-item-action in addition to the list-group-item is to add the button clicking styling to the li tag --}}
    {{-- 4. list-group-flush in addition to the list-group at the ul tag to remove the outside border --}}
    {{-- 5. list-group-numbered in addition to the list-group at the ul tag to add the numbering to the li --}}
    {{-- 6. 'list-group-item-danger', etc.. in addition to the li to add the color --}}

    {{-- Nav --}}
    {{-- 1. add the 'nav' class to the container that store all the small items  --}}
    {{-- 2. add the 'nav-item' class to the small item --}}
    {{-- 3. Since navigation is all about link, hence add the nav-link to the link tag --}}
    {{-- 4. Add the nav-tabs class if you wish to make the navigation bar like the tab --}}

    {{-- Pagination --}}
    {{-- 1. add the 'pagination' class to the container that store the all pages --}}
    {{-- 2. add the 'page-item' class to each element inside the container --}}
    {{-- 3. add 'pagination-lg' / 'pagination-sm' to the sizing of the whole pagination --}}
    {{-- 4. add justify-content-end, justify-content-center in addition to the pagination class in order to positioning the whole pagination --}}

    {{-- Spinner --}}
    {{-- 1. add the 'spinner-border' class to the tag--}}
    {{-- 2. add the 'text-secondarty, text-primary' to add the color to the spinner --}}
    {{-- 3. add the 'spinner-grow' class for the glowing effect--}}


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @forelse ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-xl-3 d-flex align-items-stretch">
                    @include('components.product-card')
                </div>
            @empty
                <p class="alert alert-danger">No product available!</p>
            @endforelse
        </div>
    </div>
    


    

@endsection