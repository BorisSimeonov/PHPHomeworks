<form method="get">
    Enter amount <input name="amount" type="text"/><br>
    <input type="radio" name="currency" value="usd"/>USD
    <input type="radio" name="currency" value="eur">EUR
    <input type="radio" name="currency" value="bgn">BGN<br>
    Compound Interest Amount <input type="text" name="interAmount"/><br>
    <select name="period">
        <option value="6">6 Months</option>
        <option value="12">1 Year</option>
        <option value="24">2 Years</option>
        <option value="36">3 Years</option>
    </select>
    <input type="submit" name="submit" value="Calculate"/>
    <?php
    if(isset($_GET['submit'])){
        $amount = htmlentities($_GET['amount']);
        $intAmount = htmlentities($_GET['interAmount']);
        $period = (int)htmlentities($_GET['period']);

        if(is_numeric($amount) && is_numeric($intAmount) && isset($_GET['currency'])){
            $amount = (float)$amount;
            for($cnt = 0; $cnt<$period; $cnt++){
                $amount = $amount + ($amount*0.01);
            }
        }
        $amount = number_format($amount, 2,".","");
        $result = $_GET['currency'];
        switch($result){
            case "usd":
                $result = "$ $amount.";
                break;
            case "bgn":
                $result = "$amount lv.";
                break;
            case "eur":
                $result = "$amount euro.";
                break;
            default:
                $result = "$amount";
                break;
        }
        echo $result;
    }
    ?>
</form>

