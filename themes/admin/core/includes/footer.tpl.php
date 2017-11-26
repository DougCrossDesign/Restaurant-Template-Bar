
<footer class="footer">

</footer>

<!-- Load Scripts -->
<script src="/<?php print('themes/' . config()->theme . '/core/assets/scripts.js'); ?>" ></script>
<?php
// TODO: Javascript stopped working here because it was doubling up on scripts
if(false && isset($GLOBALS['footerjs'])){ ?>
    <script type="text/javascript">
        <?php echo $GLOBALS['footerjs']; ?>
    </script>
<?php } ?>

<?php if(true && isset($GLOBALS['footerjs'])){ ?>
        <?php echo $GLOBALS['footerjs']; ?>
<?php } ?>


<script>
    $(".disabled :input").attr("disabled", true)
</script>
