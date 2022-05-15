$('.product-card__input').on('click', (e) => {
    e.preventDefault();
    e.stopImmediatePropagation();
});

$('document').ready(function(){
    $('.myform').on('submit',function(e, action, code) {
        e.preventDefault();
        const formData = new FormData($(e.target).closest("form")[0]);
        fetch('./productController.php?' + new URLSearchParams({ action: action, code: code }),
            { 
                method: "post", 
                body: formData,
            }
        ).then(response => {
            fetch('./nbProducts.php',
                {
                    method: "get",
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            ).then(res => {
                return res.json();
            }).then(data => {
                document.querySelector("#nb-products").textContent = data.nbProducts;
            });
        });
    });
});
 
$('.add').on("click", (e) => {
    e.preventDefault();
    const productId = $(e.target).closest("form").attr("data-id");
    $(e.target).closest("form").trigger('submit', ["add", productId]);
});