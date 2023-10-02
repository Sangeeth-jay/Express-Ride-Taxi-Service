        const menu_toggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');

        menu_toggle.addEventListener('click', () => {
            menu_toggle.classList.toggle('is-active');
            sidebar.classList.toggle('is-active');
        });

        // tab transform

        $(document).ready(function() {

            $("#tab2").click(function() {

                $(this).addClass("is-active").siblings().removeClass("is-active");
                $(".tab-history").css("visibility", "visible");
                $(".tab-booking").css("visibility", "hidden");
                $(".tab-staff").css("visibility", "hidden");
                $(".tab-feedback").css("visibility", "hidden");
                $(".tab-news").css("visibility", "hidden");
                $(".tab-vehicle").css("visibility", "hidden");

            });

            $("#tab3").click(function() {

                $(this).addClass("is-active").siblings().removeClass("is-active");
                $(".tab-staff").css("visibility", "visible");
                $(".tab-booking").css("visibility", "hidden");
                $(".tab-history").css("visibility", "hidden");
                $(".tab-feedback").css("visibility", "hidden");
                $(".tab-news").css("visibility", "hidden");
                $(".tab-vehicle").css("visibility", "hidden");


            });

            $("#tab4").click(function() {

                $(this).addClass("is-active").siblings().removeClass("is-active");
                $(".tab-feedback").css("visibility", "visible");
                $(".tab-booking").css("visibility", "hidden");
                $(".tab-history").css("visibility", "hidden");
                $(".tab-staff").css("visibility", "hidden");
                $(".tab-news").css("visibility", "hidden");
                $(".tab-vehicle").css("visibility", "hidden");


            });

            $("#tab5").click(function() {

                $(this).addClass("is-active").siblings().removeClass("is-active");
                $(".tab-news").css("visibility", "visible");
                $(".tab-booking").css("visibility", "hidden");
                $(".tab-history").css("visibility", "hidden");
                $(".tab-staff").css("visibility", "hidden");
                $(".tab-feedback").css("visibility", "hidden");
                $(".tab-vehicle").css("visibility", "hidden");


            });

            $("#tab1").click(function() {

                $(this).addClass("is-active").siblings().removeClass("is-active");
                $(".tab-booking").css("visibility", "visible");
                $(".tab-news").css("visibility", "hidden");
                $(".tab-history").css("visibility", "hidden");
                $(".tab-staff").css("visibility", "hidden");
                $(".tab-feedback").css("visibility", "hidden");
                $(".tab-vehicle").css("visibility", "hidden");


            });

            $("#tab6").click(function() {

                $(this).addClass("is-active").siblings().removeClass("is-active");
                $(".tab-vehicle").css("visibility", "visible");
                $(".tab-booking").css("visibility", "hidden");
                $(".tab-news").css("visibility", "hidden");
                $(".tab-history").css("visibility", "hidden");
                $(".tab-staff").css("visibility", "hidden");
                $(".tab-feedback").css("visibility", "hidden");


            });
        });

        
        // authentication

        let designation = document.getElementById('designation').value;

        if (designation == 2) {
            $("#tab3").addClass("disabled");
            $("#tab6").addClass("disabled");

        }

        
