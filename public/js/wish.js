$(function ()
{
    $('.toggle_wish').on('click', function ()
    {
        //表示しているプロダクトのIDと状態を取得
        product_id = $(this).attr("product_id");
        wish_product = $(this).attr("wish_product");
        click_button = $(this);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/wish_product',
            type: 'POST',
            data: { 'product_id': product_id, 'wish_product': wish_product, },
        })
            //正常にコントローラーの処理が完了した場合
            .done(function (data)
            {
                if (data == 0)
                {
                    click_button.attr("wish_product", "1");
                    click_button.children().attr("class", "fas fa-heart");
                }
                if (data == 1)
                {
                    click_button.attr("wish_product", "0");
                    click_button.children().attr("class", "far fa-heart");
                }
            })
            ////正常に処理が完了しなかった場合
            .fail(function (data)
            {
                alert(JSON.stringify(data));
                alert('いいね処理失敗');
            });
    });
});
