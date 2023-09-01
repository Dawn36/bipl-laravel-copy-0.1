{{-- <footer class="border-bottom border-5 theme-border"></footer> --}}
<script>
    window.addEventListener('load', function() {
        setTimeout(function() {
            hideLoader();
        }, 1000);

    })

    function openModalBox(title, url) {
        showLoader();
        $.ajax({
                type: 'GET',
                url: url,
            })
            .done(function(result) {
                hideLoader();
                $('#exampleModalLabel').html(`<h2>${title}</h2>`);
                $('#modalbody').html(result);
                $('#exampleModal').modal('show');
            })
            // .fail(function(jqXHR, ajaxOptions, thrownError) {
            //     alert("Server not responding.....");
            // });

    }

    /* dropdown menu start */
    //	window.addEventListener("resize", function() {
    //		"use strict"; window.location.reload(); 
    //	});


    document.addEventListener("DOMContentLoaded", function() {


        /////// Prevent closing from click inside dropdown
        document.querySelectorAll('.dropdown-menu').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        })



        // make it as accordion for smaller screens
        if (window.innerWidth < 992) {

            // close all inner dropdowns when parent is closed
            document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown) {
                everydropdown.addEventListener('hidden.bs.dropdown', function() {
                    // after dropdown is hidden, then find all submenus
                    this.querySelectorAll('.submenu').forEach(function(everysubmenu) {
                        // hide every submenu as well
                        everysubmenu.style.display = 'none';
                    });
                })
            });

            document.querySelectorAll('.dropdown-menu a').forEach(function(element) {
                element.addEventListener('click', function(e) {

                    let nextEl = this.nextElementSibling;
                    if (nextEl && nextEl.classList.contains('submenu')) {
                        // prevent opening link if link needs to open dropdown
                        e.preventDefault();
                        console.log(nextEl);
                        if (nextEl.style.display == 'block') {
                            nextEl.style.display = 'none';
                        } else {
                            nextEl.style.display = 'block';
                        }

                    }
                });
            })
        }
        // end if innerWidth

    });
    $(document).ajaxError(function myErrorHandler(
    event,
    xhr,
    ajaxOptions,
    thrownError
) {
    // $('button[id="submitbutton"]').removeAttr("disabled");
    // $(".indicator-progress").css("display", "none");
    // $(".indicator-label").css("display", "block");
    // debugger
    if (xhr.status == 401) {
        //alert("Your Session Expire Please Login Again");
       // window.location.reload();
    }
    if (xhr.status == 500) {
        //alert("Something went wrong call the admin");
        //window.location.reload();
    }
});
    // DOMContentLoaded  end
    /* dropdown menu end */
</script>
<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/script.js') }}"></script>
<script src="{{ asset('theme/assets/js/sweetalert.min.js') }}"></script>
<script>
    @yield('script')
</script>
</body>

</html>
