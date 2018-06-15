<script type="text/javascript" src="<?php echo base_url();?>js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function(){
	$.ajax({
        dataType: "json",
        type: "GET",
        url: "<?php base_url(); ?>"+"Lots/getLots",
        error: function (xhr, ajaxOptions, thrownError) {
    	console.log(thrownError);
    	},
        success: function (data) {
        	$(".lots").html("");
            if(data.length>0)
            {
            	var html = "";
                $.each(data, function(i){
                	var col = document.createElement("div");
                	$(col).addClass("col-lg-3 col-md-6 mb-lg-0 mb-4");
                	var card = document.createElement("div");
                	$(card).addClass("card");
                	var cardBody = document.createElement("div");
                	$(cardBody).addClass("card-body");
                	var cardTitle = document.createElement("h4");
                	$(cardTitle).html(data[i].varieteNom);
                	$(cardTitle).addClass("card-title");
                	var cardImage = document.createElement("img");
                	$(cardImage).addClass("card-img-top");
                	$(cardImage).attr("src", "<?php echo base_url(); ?>"+"img/variete/"+data[i].varieteImg)
                	var cardText = document.createElement("p");
                	$(cardText).html(data[i].varieteDescr);
                	var cardCart = document.createElement("a");
                	var icon = $(document.createElement("i"));
                	$(icon).addClass("fa fa-shopping-cart grey-text ml-3");
                	$(cardCart).append($(icon));
                	var cardFooter = document.createElement("div");
                	$(cardFooter).addClass("card-footer");
                	$(cardFooter).html(data[i].lotPrix+"€/"+data[i].uniteLibelle);
                	$(cardFooter).append($(cardCart));
                	$(card).append($(cardBody));
                	$(card).append($(cardTitle));
                	$(card).append($(cardImage));
                	$(card).append($(cardText));
                	$(card).append($(cardFooter));
                	$(col).append($(card));
                	$(".lots").append($(col));
                });
            }
        },
        fail: function(e) {
            console.log("fail: "+JSON.stringify(e));
        },
        complete: function(e) {
            console.log(e);
        }
    });
});
</script>
<div class="container">
	<div class="row lots">
		Chargement des produits disponibles...
	</div>
</div>