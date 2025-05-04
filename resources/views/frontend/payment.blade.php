<form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST" style="display: none;">
    <input type="text" id="amount" name="amount" value="{{$orderData["amount"]}}" required>
    <input type="text" id="tax_amount" name="tax_amount" value="0" required>
    <input type="text" id="total_amount" name="total_amount" value="{{$orderData["amount"]}}" required>
    <input type="text" id="transaction_uuid" name="transaction_uuid" value="MP{{$orderData["id"]}}" required>
    <input type="text" id="product_code" name="product_code" value="EPAYTEST" required>
    <input type="text" id="product_service_charge" name="product_service_charge" value="0" required>
    <input type="text" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
    <input type="text" id="success_url" name="success_url" value="{{route('payment.success')}}" required>
    <input type="text" id="failure_url" name="failure_url" value="{{route('payment.failed')}}" required>
    <input type="text" id="signed_field_names" name="signed_field_names"
        value="total_amount,transaction_uuid,product_code" required>
    <input type="text" id="signature" name="signature" value="{{$orderData["hash"]}}" required>
    <input value="Submit" type="submit">
</form>
<script>
    document.querySelector('form').submit();
</script>

<!-- 9806800001 -->
<!-- Nepal@123 -->
<!-- OTP: 123456 -->