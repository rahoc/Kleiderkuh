/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function showClothList(brand, gender, type, size) {
    
    //var getString = "manageClothes.php?brand="+brand+"&gender="+gender+"&type="+type+"&size="+size;
    $("#loaderImage").show();
    $("#clothList").empty();
    $.get("getClothList.php", {brand: brand, gender: gender, type: type, size: size})
        .done( function(data) {
            $("#loaderImage").hide();
            $("#clothList").html(data);
    });
}

$("#filterButton").click(function(e) {
    e.preventDefault();
    showClothList($("#brandFilter").val(), $("#genderFilter").val(), $("#typeFilter").val(), $("#sizeFilter").val());
});

$("#saveButton").click(function(e){
   e.preventDefault();
   // go through all selected
   $("input[name=selectRow]").each(function() {
       var id = this.id;
       var changed = $("#changed" + id).val();
       
       if (changed === "1" || changed === 1) {
           
           var isActive = 0;
           if ($('#active' + id).prop('checked') === true) {
               isActive = 1;
           }

           var postJSON = {
                id : id,
                actualAmount : $("#actualAmount" + id).val(),
                maxAmount : $("#maxAmount" + id).val(),
                price : $("#price" + id).val(),
                active : isActive
           }
           
           $.post("changeCloth.php", postJSON)
                   .done(function(data) {
                       $("#messages").text(data);
                      showClothList($("#brandFilter").val(), $("#genderFilter").val(), $("#typeFilter").val(), $("#sizeFilter").val());
           });
            //alert(postJSON);
            
        } // if changed
   });
   
});

function doMultiEdit() {
	var act = document.getElementById("multiEditAct").value;
	var maxi = document.getElementById("multiEditMax").value;
	var price = document.getElementById("multiEditPrice").value;
	var allRowCheckboxes = document.getElementsByName("selectRow");
	
	for (i=0;i<allRowCheckboxes.length;i++) {
		if(allRowCheckboxes[i].value==1) {
                    var id = allRowCheckboxes[i].id;
                    if(act !== "") {
			document.getElementById("actualAmount" + id).value = act;
                    }
                    if(maxi !== "") {
			document.getElementById("maxAmount" + id).value = maxi;
                    }
                    if(price !== "") {
			document.getElementById("price" + id).value = price;
                    }
                    inputValueChanged(id);
		}
	}
}

// if an input element is changed, the hidden field "changedID" is set to 1
function inputValueChanged(id) {
	document.getElementById("changed" + id).value = 1;
}

// if an input element is changed, the hidden field "changedID" and "changedClothID" is set to 1
function inputValueChanged(id, cid) {
	document.getElementById("changed" + id).value = 1;
	//document.getElementById("changedCloth" + cid).value = 1;
}

function changeOrderBy(name) {
	var orderByString = document.getElementById("orderBy").value;
	var orderByArray = orderByString.split(", ");
	
	orderByString = name;
	for(i=0;i<orderByArray.length;i++) {
		if(orderByArray[i] == name) {
			continue;
		}
		orderByString = orderByString + ", " + orderByArray[i];
	}
	
	document.getElementById("orderBy").value = orderByString;
}


function toggleAll() {
	var allRowCheckboxes = document.getElementsByName("selectRow");
	if(document.getElementById("selectAll").checked) {
		for (i=0;i<allRowCheckboxes.length;i++) {
			allRowCheckboxes[i].setAttribute("checked", "checked");
			allRowCheckboxes[i].value=1;
		}
	}
	else {
		for (i=0;i<allRowCheckboxes.length;i++) {
			allRowCheckboxes[i].removeAttribute("checked");
			allRowCheckboxes[i].value=0;
		}
	}
}

function toggleMe(id) {
	var me = document.getElementById(id);
	if(me.checked) {
			me.setAttribute("checked", "checked");
			me.value=1;
	}
	else {
			me.removeAttribute("checked");
			me.value=0;
	}
}

