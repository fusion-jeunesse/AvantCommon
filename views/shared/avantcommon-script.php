<script type="text/javascript">
var REQUEST_IMAGE_URL = <?php echo json_encode($requestImageUrl); ?>;
var REQUEST_IMAGE_TEXT = <?php echo json_encode($requestImageText); ?>;
var ITEM_LINK_TEXT = <?php echo json_encode($itemLinkText); ?>;

jQuery(document).ready(function()
{
    jQuery('.lightbox').magnificPopup(
    {
        type: 'image',
        gallery: {
            enabled: true
        },
        image: {
            titleSrc: function (item)
            {
                return constructLightboxCaption(item);
            }
        }
    }
    );
});
</script>
