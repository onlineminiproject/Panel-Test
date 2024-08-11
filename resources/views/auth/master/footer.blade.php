</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
</script>
<script src="{{ asset('hub/plugins/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('hub/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('hub/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('hub/plugins/screenfull/dist/screenfull.js') }}"></script>
<script src="{{ asset('hub/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('hub/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('hub/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('hub/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('hub/plugins/jvectormap/jquery-jvectormap.min.js') }}"></script>
<script src="{{ asset('hub/plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('hub/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('hub/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('hub/plugins/d3/dist/d3.min.js') }}"></script>
<script src="{{ asset('hub/plugins/c3/c3.min.js') }}"></script>
<script src="{{ asset('hub/js/tables.js') }}"></script>
<script src="{{ asset('hub/js/widgets.js') }}"></script>
<script src="{{ asset('hub/js/charts.js') }}"></script>
<script src="{{ asset('hub/dist/js/theme.min.js') }}"></script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#datepicker").datetimepicker({
            format: 'YYYY-MM-DD'
        })
    })
</script>

<script>
    (function(b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function() {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = 'https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X', 'auto');
    ga('send', 'pageview');
</script>


<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the icon class
        this.classList.toggle('ik-eye');
        this.classList.toggle('ik-eye-off');
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        const passwordConfirmInput = document.getElementById('password_confirmation');
        const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmInput.setAttribute('type', type);

        // Toggle the icon class
        this.classList.toggle('ik-eye');
        this.classList.toggle('ik-eye-off');
    });
  
</script>

</body>

</html>
