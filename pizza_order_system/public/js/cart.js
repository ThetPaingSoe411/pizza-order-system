$(document).ready(function(){
    $('.btn-plus').click(function(){
        //when plus-btn click
    $parentNode = $(this).parents('tr');
      $price=Number($parentNode.find('#price').text().replace('kyats',''));
      $qty=Number($parentNode.find('#qty').val());
      $total=$price*$qty;
      $parentNode.find('#total').html($total + 'kyats');
      //total summary
       summaryCalculation();

    })
    $('.btn-minus').click(function(){
     //when minus-btn click
        $parentNode = $(this).parents('tr');
      $price=Number($parentNode.find('#price').text().replace('kyats',''));
      $qty=Number($parentNode.find('#qty').val());
      $total=$price*$qty;
      $parentNode.find('#total').html($total + 'kyats');
        //total summary
        summaryCalculation();
    })
    $('.btnRemove').click(function(){
        $parentNode=$(this).parents('tr');
        $productId=$parentNode.find('.productId').val();
        console.log($productId);
        $parentNode.remove();
        summaryCalculation();
    })

    function summaryCalculation(){
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index,row){
            $totalPrice += Number($(row).find('#total').text().replace('kyats',''));
        });
        $('#subTotalPrice').html(`${$totalPrice} kyats`);
        $('#finalPrice').html(`${$totalPrice + 3000} kyats`);

    }
})
