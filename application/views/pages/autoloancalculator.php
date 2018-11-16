<!--Auto loan calculator-->
<div class="col-lg-8 mb-4">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col text-center">
                            <h4 class="mb-4"><b>Auto Loan Calculator</b></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pt-4 text-center">
                            <input type="text" class="form-control" name="cost" id = "cost" placeholder="Cost of Car ">
                        </div>
                        <div class="col-12 pt-4 text-center">
                            <select name = "creditscore" id = "creditscore" class="form-control input-lg">
                                <option value = "">What is Your Credit Score</option>
                                <option value = "780">Excellent: 780</option>
                                <option value = "680">Good: 680</option>
                                <option value = "630">Average: 630</option>
                                <option value = "588">Below Average: 588</option>
                            </select>

                        </div>
                        <div class="col-12 pt-4 text-center">
                            <select name = "loanTerm" id = "loanTerm" class="form-control input-lg">
                                <option value = "">Choose Your Loan Term</option>
                                <option value = "72">72 Month</option>
                                <option value = "60">60 Month</option>
                                <option value = "48">48 Month</option>
                                <option value = "36">36 Month</option>
                            </select>
                        </div>
                        <div class="col-12 pt-4 text-center">
                            <input type="text" name = "downpayment" id = "downpayment" class="form-control input-lg" placeholder ="What is Your Down Payment" required=""> 
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-12 pt-4 text-center">
                            <button type="button" class="btn btn-primary btn-lg btn-block" id="caluclateBtn" name="caluclateBtn">CALCULATE</button>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 mb-4" style="padding-top: 100px;">
    <div class="row align-items-center justify-content-md-center" style="background-color: #FF7171; height: 250px; color: #FFF;">
        <div class="col-md-auto text-center">
            <h1>Monthly Payment</h1>
            <h3 id="priceValue"></h3>
        </div>
    </div>
</div>

