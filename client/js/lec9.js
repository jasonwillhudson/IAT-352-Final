// alert(123);
$("document").ready(function() {
	$("a.action").hover(
		function () {
			$(this).closest("li").css( "background-color", "yellow" );
			}, 
		function () {
			$(this).closest("li").css( "background-color", "white" );
			} 
	);
	
	$("li a.action").click(
		function (event) {
			event.preventDefault();
			// get the URL,with productCode, from HREF
			var myUrl = $(event.target).attr("href"); 
			var selected = [];
			var idToRemove = $(event.target).closest("li").attr("id"); 
			selected.push(idToRemove);
    		//send it asynchronously via GET request
    		$.ajax({
    			type: 'GET',
    			url: myUrl,
    			//data is in the form of key: value
    			data: { productCode: selected},
    			success: function(data){
					$(event.target).closest("li").remove();
					$("#msg").html(data);
					$("#msg").fadeOut(2000, function() {
						$(this).html("");	
						});					
    				}
    			})    						
		    });
		    	
	$("button").click(
		function (event) {
			event.preventDefault();
			// get the URL from button formaction
			var myUrl = $(event.target).attr("formaction"); 
			//now collect checked checkboxes
			var boxes = $(".watch_checks"); //all have this class
			var selected = [];
			for( var i = 0; i < boxes.length; ++i) 
				if(boxes[i].checked)
					//using DOM model to get the value
					selected.push(boxes[i].parentElement.attributes["id"].value);
			console.log(selected);
			//send it asynchronously via GET request
    		if (selected.length > 0) 
    			$.ajax({
    				type: 'GET',
					url: myUrl,
					data: { productCode: selected },
					success: function(data){
						for(var i = 0; i < selected.length; ++i)
							$("#"+selected[i]).remove();
						$("#msg").html(data);
						$("#msg").fadeOut(2000, function() {
							$(this).html("");	
							});					
						}
					})    						
				});

	$("#searchBtn").on("click",
		function (event){
			// alert(123);
			event.preventDefault();
			getFilterOptionResult();
			var filterConditionJSON = createFilterCondition();
			getSearchResult(filterConditionJSON);
			getFilterOptionResult();

		}
	);

	$("#displayFilter").on("mouseenter", "#priceFilterBtn", function(){
		$("#priceFilterBtn").on("click",
		function (event){
			// event.preventDefault();
			var filterConditionJSON = createFilterCondition();
			getSearchResult(filterConditionJSON);
			
		});
	});

	$("#displayFilter").on("mouseenter", ".category", function(){
		$(".category").on("click",
		function (event){
			var filterConditionJSON = createFilterCondition();
			getSearchResult(filterConditionJSON);

		});
	});

	$("#displayFilter").on("mouseenter", ".brand", function(){
		$(".brand").on("click",
		function (event){
			var filterConditionJSON = createFilterCondition();
			console.log(filterConditionJSON);
			getSearchResult(filterConditionJSON);

		});
	});

	function getSearchResult(jsonData){
		// console.log(jsonData);
		$.ajax(
			{
				type: "GET",
				url: "../pages/getSearchResult.php",
				data: jsonData,
				success: function(data){
					$("#displayResult").html(data);
				}
			}
		);
	};

	function getFilterOptionResult(){
		$.ajax(
			{
				type: "GET",
				url: "../pages/getFilterResult.php",
				data: {search : $.trim($(".search").val())},
				success: function(data){
					$("#displayFilter").html(data);
				}
			}
		);
	};

	function createFilterCondition(){
		var filterConditionJSON = {};
		if ($.trim($(".search").val()) != ""){
			filterConditionJSON["search"] = $.trim($(".search").val());
		}
		var categorys = $(".category");
		var selected = [];
		for( var i = 0; i < categorys.length; ++i) {
			if(categorys[i].checked){
				selected.push(categorys[i].value);
			}
		}
		if (selected.length > 0){
			filterConditionJSON["category"] = selected;
		}

		if ($.trim($(".priceFrom").val()) != "" && $.trim($(".priceFrom").val()) != ""){
			filterConditionJSON["priceFrom"] = $.trim($(".priceFrom").val());
			filterConditionJSON["priceTo"] = $.trim($(".priceTo").val());
		}

		var brand = $(".brand");
		var selected = [];
		for( var i = 0; i < brand.length; ++i) {
			if(brand[i].checked){
				selected.push(brand[i].value);
			}
		}
		if (selected.length > 0){
			filterConditionJSON["brand"] = selected;
		}

		return filterConditionJSON;
	};

	//

});

fn = function(){

	console.log($(this));
}


    