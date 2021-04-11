@extends('template.master')
@section('title', 'Customer')
@section('content')
<style>
    /* @media screen and (max-width: 425px) {

        li.page-item {

            display: none;
        }

        .page-item:first-child,
        .page-item:nth-child(2),
        .page-item:nth-last-child(2),
        .page-item:last-child,
        .page-item.active,
        .page-item.disabled {

            display: block;
        }
    } */
</style>

<div class="row mt-2 mb-2">
    <div class="col-lg-6 mb-2">
        <a href="{{route('customer.add')}}" class="btn btn-sm shadow-sm myBtn">
            <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="black">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </a>
    </div>
    <div class="col-lg-6">
        <form class="d-flex" method="GET" action="{{route('customer.search')}}">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search"
                name="q" value="">
            <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm border">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" style="white-space: nowrap">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Job</th>
                                <th scope="col">Date of birth</th>
                                <th scope="col">Age</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                <td>{{($customers ->currentpage()-1) * $customers ->perpage() + $loop->index + 1}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->user->email}}</td>
                                <td>{{$customer->address}}</td>
                                <td>{{$customer->job}}</td>
                                <td>{{$customer->birthdate}}</td>
                                <td>{{\Carbon\Carbon::parse($customer->birthdate)->diff(\Carbon\Carbon::now())->format('%y years, %m months')}}
                                </td>
                                <td>
                                    <a class="btn btn-light btn-sm rounded shadow-sm border"
                                        href="{{route('customer.edit',['customer'=>$customer->id])}}">
                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <a class="btn btn-light btn-sm rounded shadow-sm border delete" href="#"
                                        customer-id="{{$customer->id}}" customer-name="{{$customer->name}}" customer-url="{{route('customer.destroy',['customer'=>$customer->id])}}">
                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                    <a class="btn btn-light btn-sm rounded shadow-sm border"
                                        href="/customer/detail/{{$customer->id}}">
                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <h3>Customer</h3>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-md-center mt-3">
    <div class="col-sm-10 d-flex justify-content-md-center">
        {{ $customers->onEachSide(2)->links("pagination::bootstrap-4") }}
    </div>
</div>

@endsection

@section('footer')
<script>
    $('.delete').click(function(){
        var customer_id = $(this).attr('customer-id');
        var customer_name = $(this).attr('customer-name');
        var customer_url = $(this).attr('customer-url');
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: customer_name+" will be deleted, You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel! ',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = customer_url;
        }
    })
    });
</script>
@endsection
