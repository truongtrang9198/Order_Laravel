
<div class="container-fluid">
    <div class="row">
        <div class="col-xm-12 col-md-12" id="top-header">
            <div>
            <img src="{{asset('order.png')}}" alt="" >
            <br>
             <span class="text-light"><i class="fas fa-user-check"></i>
                @if (session('username') != '')
                        <span><a href="{{route('history')}}">{{ session('username')}}</a></span>
             @endif
             </span>
            </div>
            <div class="slide_img">

            </div>

        </div>
    </div>

</div>
