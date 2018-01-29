<?php
$this->startIfEmpty('script');
?>
<script>
    if(typeof '<?php echo json_encode($ajax['status']);?>' != 'undefined'){
        var jsonStatut = $.parseJSON('<?php echo json_encode($ajax['status']);?>');
        var jsonMessage = $.parseJSON('<?php echo json_encode($ajax['message']);?>');
        if(jsonStatut == "success"){
            toastr["success"](jsonMessage);
        }else{
            if(jsonMessage != ""){
                toastr["error"](jsonMessage);
            }else{
                toastr["error"]("Erreur lors de l'enregistrement de la modification");
            }
        }
    }
    setInterval(function(){ document.location.href="http://127.0.0.1:8080/vegeta/"; }, 1200);
</script>
<?php
$this->end();
?>