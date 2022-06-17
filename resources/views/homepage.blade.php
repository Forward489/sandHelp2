@extends('layouts.main')

@section('container')
    <h2>Welcome to home page</h2>
    @auth
        @if (!auth()->user()->profile_picture)
            <img src="{{ auth()->user()->avatar }}" alt="">
        @else
            <div style="max-height: 150px; max-width: 150px; overflow: hidden;">
                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="">
            </div>
        @endif
        <div class="m-2">
            <p>{{ auth()->user()->description }}</p>
        </div>
    @endauth

    <div class="row">
        {{-- <form action="" method="GET"> --}}
        <div class="col-lg-8">
            <div class="mb-3">
                <label for="name" class="form-label">Search Bar</label>
                <input type="text" class="form-control" id="name" placeholder="Search form name here">
            </div>
        </div>
        {{-- <div class="col-lg-4">
                <button type="submit" class="btn btn-primary">Search</button>
            </div> --}}
        {{-- </form> --}}
    </div>



    <div class='container-result m-2' id="container-result">
        {{ csrf_field() }}
        <div class="result m-2" id="result"></div>
    </div>

    
    <script>
        $(document).ready(function() {
            // var search_bar = $('#name').val();
            // ajaks(search_bar);
            // $('#name').on('keyup', function() {
            //     var search_bar = $('#name').val();
            //     console.log(search_bar);
            //     // alert(search_bar);
            //     ajaks(search_bar);
            // });
            var _token = $('input[name="_token"]').val();
            loadData('', _token);

            $(document).on('click', '#load_more_button', function() {
                var points = $(this).data('points');
                // var name = $('#name').val();
                // console.log(points);
                $('#load_more_button').html('Loading. . .');
                loadData(points, _token);
            });
            $(document).on('keyup', '#name', function() {
                // var points = $(this).data('points');
                var name = $(this).val();
                if(!(name=="")) {
                    loadNames(name, 0, _token);
                } else {
                    $('#result').html('');
                    // loadNames(name, 0, _token);
                    loadData("", _token);
                }
            });
            $(document).on('click', '#load_more_names', function() {
                var points = $(this).data('points');
                var name = $('#name').val();
                // console.log(points);
                $('#load_more_names').html('Loading. . .');
                loadNames(name, points, _token);
            });
        });

        function loadNames(name="", points=0, _token) {
            $.ajax({
                url: "{{ route('loadmore.load_names') }}",
                method: 'POST',
                data: {
                    name:name, _token:_token, points:points
                },
                dataType: 'json',
                success: function(data) {
                    // alert(data.table_button);
                    // $('#result').html(data.table_data);
                    if(data.new_data) {
                        $('#load_more_names').remove();
                        $('#result').html(data.output);
                    } else if (!data.new_data) {
                        $('#load_more_names').remove();
                        $('#result').append(data.output);
                    }
                    // console.log(data.count);
                }
            });
        }

        function ajaks(name = '') {
            // alert(name);
            $.ajax({
                url: "{{ route('getTableResult') }}",
                method: 'GET',
                data: {
                    query: name
                },
                dataType: 'json',
                success: function(data) {
                    // alert(data.table_button);
                    $('#result').html(data.table_data);
                }
            });
        }


        function loadData(points="", _token) {
            $.ajax({
                url: "{{ route('loadmore.load_data') }}",
                method: 'POST',
                data: {
                    points:points, _token:_token
                },
                success: function(data) {
                    // alert(data.table_button);
                    // $('#result').html(data.table_data);
                    $('#load_more_button').remove();
                    // alert(data)
                    $('#result').append(data);
                }
            });
        }
        
        

        // var count = 0;
        // $(document).ready(function() {
        //     var big_cat = $(".big_cat").val();
        //     $('.form-check').on('change', function() {
        //         var isChecked = ($(this).children('input').is(':checked'));
        //         ajaks($(this).children('input').val(), isChecked);
        //     });
        // });

        // function ajaks(name) {
        //     $.ajax({
        //         url: "/result",
        //         method: 'GET',
        //         data: {
        //             query: name
        //         },
        //         dataType: 'json',
        //         success: function(data) {
        //             if (y) {
        //                 var append = (count % 3 == 0) ? '<div class="d-block"></div>' : '';
        //                 $('#' + data.data_category).append(data.table_data + append);
        //             } else {
        //                 // alert(data.data_category)
        //                 x = x.split(' ').join('_')
        //                 // alert(x)
        //                 $('#' + data.data_category).children('#result-' + x).remove();
        //             }

        //         }
        //     });

        // }
    </script>
@endsection
