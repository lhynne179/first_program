$(function() {
    // headers = {
    //     'content-type': 'application/json',
    // }

    toastr.options = {
        "maxOpened": 1,
        "autoDismiss": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    //function to retrieve all products
    function all() {
        axios.get('./controller/product_mid.php', { params: { view: "all" } })
            .then((response) => {
                $("tbody").html(response.data)

            })
    }

    all() //call all when page loads


    function parseMessageCreateUpdate(data) {
        switch (data.data.status) {
            case "Ok":
                toastr.success(data.data.response)
                break;
            case "Error":
                toastr.error(data.data.response)
                break;
        }
    }


    $("form").submit(function(e) {

        e.preventDefault();
        const formData = new FormData($("form")[0]);
        // formData.append('name', $("input[name='name']").val())
        // formData.append('price', $("input[name='price']").val())
        // formData.append('stock', $("input[name='stock']").val())
        formData.delete("function")
        if ($(this).find("input[type='hidden']").val() === "") {
            formData.append('function', "create")
            axios.post('./controller/product_mid.php', formData)
                .then((response) => {

                    parseMessageCreateUpdate(response)
                    all()
                })
        } else {
            formData.append('function', "update")
            formData.append('id', $("input[name='id']").val())
            axios.post('./controller/product_mid.php', formData).then((response) => {
                parseMessageCreateUpdate(response)
                all();

            })

        }

        $("#staticBackdrop").modal('hide')
        $("form").trigger('reset')
    })



    $("#search_product").change(function() {
        axios.get("./controller/product_mid.php", {
            params: {
                pname: $(this).val(),
                view: "by_name"
            }
        }).then((response) => {
            $("tbody").html(response.data)
        })
    })

    //update data from from







})