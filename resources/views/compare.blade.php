@extends('layouts.user')

@section('title')
    Find Your Suitable Laptop - BukaLaptop.com
@endsection

@section('content')
    <div class="container pb-24 px-4 mx-auto compare">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-x-3 items-center justify-center">
            <div class="" id="prod1">
                <div class="flex flex-col h-56 border p-4 border-gray-400 border-dashed justify-center items-center">
                    <img class="w-full max-h-28 object-contain" src="" id="prod1img" />
                    <h6 id="prod1title"></h6>

                    <button class="btn btn-secondary" onclick="selectProduct(1)">Select</button>
                </div>
            </div>
            <div class="hidden md:flex items-center justify-center">
                <h4>VS</h4>
            </div>
            <div class="" id="prod2">
                <div class="flex flex-col h-56 border p-4 border-gray-400 border-dashed justify-center items-center">
                    <img class="w-full max-h-28 object-contain" src="" id="prod2img" />
                    <h6 id="prod2title"></h6>
                    <button class="btn btn-secondary" onclick="selectProduct(2)">Select</button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-x-3 items-center justify-center border border-gray-200 mt-5">
            <div class="" id="spec1">
                <ul id="spec1_list">
                </ul>
            </div>
            <div class="" id="spec_param">
                <ul>
                    <li class="param">
                        Memory
                    </li>
                    <li class="param">
                        Battery
                    </li>
                    <li class="param">
                        Processor
                    </li>
                    <li class="param">
                        Screen Size
                    </li>
                    <li class="param">
                        Storage
                    </li>
                    <li class="param">
                        Storage Capacity
                    </li>
                    <li class="param">
                        Graphic
                    </li>
                    <li class="param">
                        View Detail
                    </li>
                </ul>
            </div>
            <div class="" id="spec2">
                <ul id="spec2_list">
                </ul>
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
            $('#select_product').css({
                "transform": "translateY(0)"
            })

            $('#search_list').html(' ');

            $('#search_input').val("");

        }

        function updateProduct() {
            if (data1) {
                $('#prod1img').attr("src", data1.image);
                $('#prod1title').html(data1.name)
                $("#spec1_list").html(
                    `
                    <li>
                        ${data1.ram}
                    </li>

                    <li>
                        ${data1.battery_capacity}
                    </li>

                    <li>
                        ${data1.cpu}
                    </li>

                    <li>
                        ${data1.screen_size}
                    </li>

                    <li>
                        ${data1.hard_disk}
                    </li>

                    <li>
                        ${data1.hard_disk_capacity}
                    </li>

                    <li>
                        ${data1.graphic_card}
                    </li>

                    <li>
                        <a href="{{ url('products/` + data1.name + `') }}">See Product</a>
                    </li>
                    `
                )

            }

            if (data2) {
                $('#prod2img').attr("src", data2.image);
                $('#prod2title').html(data2.name)
                $("#spec2_list").html(
                    `
                    <li>
                        ${data2.ram}
                    </li>

                    <li>
                        ${data2.battery_capacity}
                    </li>

                    <li>
                        ${data2.cpu}
                    </li>

                    <li>
                        ${data2.screen_size}
                    </li>

                    <li>
                        ${data2.hard_disk}
                    </li>

                    <li>
                        ${data2.hard_disk_capacity}
                    </li>

                    <li>
                        ${data2.graphic_card}
                    </li>

                    <li>
                        <a href="{{ url('products/` + data2.name + `') }}">See Product</a>
                    </li>
                    `
                )

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
            else if (currentType === 2)
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
