<section id="footer">
    <div class="footer">
        <p>جميع حقوق النشر محفوظة &copy; 2022
            <br>
            تصميم: <a href="#" target="_parent">مجموعتنا</a>
            <br>
        </p>
    </div>
</section>

<script src="<?php echo URL; ?>public/js/perfect-scrollbar.min.js"></script>
<script src="<?php echo URL; ?>public/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo URL; ?>public/js/jquery.js"></script>
<script src="<?php echo URL; ?>public/js/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let table2 = document.querySelector('#table2');
    if (table1) {
        let dataTable1 = new simpleDatatables.DataTable(table1);
    }
    if (table2) {
        let dataTable2 = new simpleDatatables.DataTable(table2);
    }
</script>
<script src="<?php echo URL; ?>public/js/wejhtak.js"></script>
<noscript>Sorry, your browser does not support JavaScript!</noscript>
</body>

</html>