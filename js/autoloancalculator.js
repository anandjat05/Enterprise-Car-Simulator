 
			var costEle=document.getElementById("cost");
        	var creditscoreEle =document.getElementById("creditscore");
        	var loanTermEle =document.getElementById("loanTerm");
        	var downpaymentEle =document.getElementById("downpayment");

            window.addEventListener("load", function(){
                document.getElementById("caluclateBtn").addEventListener("click", function(){

			var costVal=parseInt(costEle.value);
        	var creditscoreVal =creditscoreEle.value;
        	var loanTermVal = parseInt(loanTermEle.value);
        	var downpaymentVal =downpaymentEle.value;
	        

        	 if(!validation()) //false then return
        	 	return;

        	var interest;
        	var price;
        	var totalPrice;

        	//switch function used to calculate the cerdit score.
        	switch (creditscoreVal) {

				  case '780':
				    	interest = (0.15* costVal)/100 ;
				    break;
				  case '680':
				  		interest = (0.20* costVal)/100 ;
				 	break;
				  case '630':
				  		interest = (0.25* costVal)/100 ;
				  	break;
				  case '588':
				    	interest = (0.30* costVal)/100 ;
				    break;
				  default:
				    interest = 'Sorry We cannot provide you Loan';
				}

			//	calculate the price
            // debugger
            console.log('interest',interest)
			price = (parseInt(costVal) - parseInt(downpaymentVal))/parseInt(loanTermVal);
            
			totalPrice =(price + interest).toFixed(2);

            console.log('totalprice ',totalPrice)
            console.log('price + interest ', price + interest)
           // console.log(totalPrice.toFixed(2));
            document.getElementById("priceValue").innerHTML = "$ "+totalPrice;

        }, false);//end event-listner for button

    }, false);

    function validation(){
    		var costVal=costEle.value;
        	var creditscoreVal =creditscoreEle.value;
        	var loanTermVal =loanTermEle.value;
        	var downpaymentVal =downpaymentEle.value;

        if(costVal =="" || isNaN(costVal)){
            
            alert("Please Insert Valid Car Cost!");
            return false;
        }
        if(creditscoreVal ==""){
        	
        	alert("Please select Credit Score");
        	return false;
        }
        if(loanTermVal ==""){
        	
        	alert("Please select Your Loan Term");
        	return false;

        }
        if(downpaymentVal =="" || isNaN(downpaymentVal)){
            
            alert("Please Insert Valid Down Payment!");
            return false;
        }
        if(parseInt(costVal) < parseInt(downpaymentVal)){
                alert("Car cost must greater than Downpayment");
                return false;
            }
        return true;
    }
