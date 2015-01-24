<script src="<?php echo $this->staticFile('js/app.js')?>"></script>

    <script src="<?php echo $this->staticFile('js/plugin.js')?>"></script>
    

<script>
require(["gitbook"], function(gitbook) {
    var config = {"fontSettings":{"theme":null,"family":"sans","size":2}};
    gitbook.start(config);
});
</script>
