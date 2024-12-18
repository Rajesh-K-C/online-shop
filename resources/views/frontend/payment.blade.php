
<form action="https://uat.esewa.com.np/epay/main" method="POST">
    <input value="{{$orderData["amount"]}}" name="tAmt" type="hidden">
    <input value="{{$orderData["amount"]}}" name="amt" type="hidden">
    <input value="0" name="txAmt" type="hidden">
    <input value="0" name="psc" type="hidden">
    <input value="0" name="pdc" type="hidden">
    <input value="EPAYTEST" name="scd" type="hidden">
    <input value="MP{{$orderData["id"]}}" name="pid" type="hidden">
    <input value="{{route('payment.success')}}" type="hidden" name="su">
    <input value="{{route('payment.failed')}}" type="hidden" name="fu">
</form>
<script>
    document.querySelector('form').submit();
</script>

<!-- 9806800001 -->
<!-- Nepal@123 -->