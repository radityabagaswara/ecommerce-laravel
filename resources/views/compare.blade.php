@extends('layouts.user')

@section('title')
    Find Your Suitable Laptop - BukaLaptop.com
@endsection

@section('content')
    <div class="container px-4 mx-auto">
        <div class="grid grid-cols-12 gap-x-3">
            <div class="col-span-4" id="prod1">
                <div
                    class="flex flex-col max-w-sm h-56 border p-4 border-gray-400 border-dashed justify-center items-center">
                    <img class="w-full max-h-32 object-contain" src="" id="prod1img" />
                    <h6 id="prod1title"></h6>

                    <button class="btn btn-secondary" onclick="selectProduct(1)">Select Products</button>
                </div>
            </div>

            <div class="col-span-4">
                Hello
            </div>
            <div class="col-span-4" id="prod2">

                <div
                    class="flex flex-col max-w-sm h-52 border p-4 border-gray-400 border-dashed justify-center items-center">
                    <img class="w-full max-h-32 object-contain" src="" id="prod2img" />
                    <h6 id="prod2title"></h6>
                    <button class="btn btn-secondary" onclick="selectProduct(2)">Select Products</button>
                </div>
            </div>
        </div>
    </div>


    <div class="fixed top-0 left-0 bg-white w-screen h-screen z-50 mt-28 border transition-all duration-500"
        id="select_product" style="transform: translateY(2500px)">
        <div class="container px-4 mx-auto py-10">
            <div class="topbar flex flex-row justify-between border-b pb-5">
                <h6>Select Product</h6>
                <a href="#" onclick="closeSel(event)">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <div class="mt-5">
                <input type="text" class="form-input rounded w-full" placeholder="Search Products" id="search_input">
                <div class=" w-full p-4 border border-gray-200 bg-white rounded hidden" id="search_container">
                    <p id="search_loader">Loading</p>
                    <ul id="search_list">
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let currentType = 1;
        searchData = [];
        let data1 = null;
        let data2 = null;

        function selectProduct(type) {
            event.preventDefault();
            currentType = type;
            // $('#select_product').removeClass("hidden")
            $('#select_product').css({
                "transform": "translateY(0)"
            })

            $('#search_list').html(' ');

            $('#search_input').val("");

        }



        function updateProduct() {
            console.log(data1.image);
            if (data1) {
                $('#prod1img').attr("src", data1.image);
                $('#prod1title').html(data1.name)

            }

            if (data2) {
                $('#prod2img').attr("src", data2.image);
                $('#prod2title').html(data2.name)

            }
        }


        function closeSel(event) {
            event.preventDefault();
            $('#select_product').css({
                "transform": "translateY(2500px)"
            })
        }

        function selData(index) {
            if (currentType === 1)
                data1 = searchData[index];
            else
                data2 = searchData[index];

            $('#select_product').css({
                "transform": "translateY(2500px)"
            })
            updateProduct();

        }


        $("#search_input").on('input', function(event) {
            const searchTerms = $("#search_input").val();

            if (searchTerms.length < 3) return $("#search_container").addClass("hidden")
            $("#search_container").removeClass("hidden")

            $.ajax({
                type: 'POST',
                url: '{{ route('api.products.search') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    query: searchTerms
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#search_loader').html("Loading...")
                },
                success: function(res) {
                    $('#search_list').html(' ');

                    if (res.data.products.length < 1)
                        $('#search_loader').html("0 Result(s) Found!")
                    else
                        $('#search_loader').html(`Showing ${res.data.products.length} Result(s)`)

                    searchData = res.data.products;

                    res.data.products.map((e, index) => {
                        $('#search_list').append(`
                            <li class="py-2 border-b border-gray-200 cursor-pointer" onclick="selData(${index})">
                                    <div class="grid grid-cols-12">
                                        <div class="col-span-12 md:col-span-1 max-h-12">
                                            <img class="md:w-full h-full object-contain"
                                                src="${e.image}">
                                        </div>
                                        <div class="col-span-12 md:col-span-9">
                                            <h6 class="text-sm">${e.name}</h6>
                                            <p><small>${e.brands.name} | ${e.categories.name}</small></p>

                                        </div>
                                        <div class="col-span-12 md:col-span-2">
                                            ${e.discount > 0 ? `<p class="text-sm"><span class="line-through">Rp ${e.sub_total}</span> <span class="text-red-500">-${e.discount}%</span></p>` : ``}
                                            <p class="text-sm text-indigo-500 font-semibold">Rp ${e.format_total}</p>
                                        </div>
                                    </div>
                            </li>
                        `)
                    })

                }
            })


        })
    </script>
@endsection
