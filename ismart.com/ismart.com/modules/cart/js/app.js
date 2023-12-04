$(document).ready(function () {
   $('.num-order').change(function () {
        var id = $(this).data('id');
        var qty = $(this).val();
        var price = $(this).parent().find('.price').text();
        var data = {id: id, price: price, qty: qty};
//        console.log(data);
       $.ajax({
           url: "?mod=cart&act=process", // Trang xử lý, mặc định trang hiện tai
           method: 'POST', // Post hoặc Get, mặc định Get
           data: data, // Dữ liệu truyền lên server ++ Lấy phía trên đã khai báo
           dataType: 'json', // html , text, script hoặc json
           success: function (data) {
               	console.log(data);
                $("#sub-total-" + id).text(data.sub_total);
                $("#total-price-products").text(data.total);
                // $("#num").text(data.num_order)
           },
       });
   });
});

