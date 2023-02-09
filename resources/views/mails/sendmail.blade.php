@extends('mails.layout')

@section('content_email')
<div style="margin-top: 30px !important;margin-bottom: 20px">

    <div style="margin-top: 20px; padding: 20px 20px; border-bottom: 2px solid #fff;background: #F2F2F2; color: #5B5B5B">
        <h4 style="text-align:center; font-size: 18px; color: #000">
            {{ $data['title'] }}
        </h4>
        <p style="text-align:left; color: #000; font-size:16px">
            Hello culinary friends, now on Wids Roti a new menu is available, you know!
        </p>
        <p style="text-align:left; color: #000; font-size:16px">
            Want to know what the menu is? Let's order now via {{ $data['status_order'] == true ? $data['order_online'] : 'Go-Food Or GrabFood' }}.
        </p>
        <hr />
        <center>
            <img src="{{ $data['foto'] }}" class="img-custom" alt="{{ config('app.brand') }}" title="{{ config('app.brand') }}">
        </center>
        <p style="color: #000 !important; text-align:left; font-size:16px">
            <ul>
                <li>
                    Menu : {{ $data['nama_menu'] }}
                </li>
                <li>
                    Price :
                    @php
                    if($data['diskon'] == 0)
                    {
                    echo $data['mata_uang'] . ' ' . number_format($data['harga_real'], 0, '.', '.');
                    } else {
                    echo '
                    <span style="text-decoration: line-through; color: #999999">
                        ' . $data['mata_uang'] . ' ' .number_format($data['harga'], 0, '.', '.') . '
                    </span>
                    <span>' . $data['mata_uang'] . ' ' .number_format($data['harga_real'], 0, '.', '.') . '</span>
                    ';
                    }
                    @endphp
                </li>
                <li>
                    Discount : {{ $data['diskon'] }}%
                </li>
                <li>
                    Available In : {{ $data['order_online'] }}
                </li>
            </ul>

            <center>
                <h3 style="font-weight: bold; font-size: 20px;">
                    Order Here
                </h3>
                <br />
                <div>
                    @if ($data['status_order'] == true)
                    @if($data['order_online'] == 'GRAB FOOD')
                    <a href="{{ $data['link_order'] }}" target="_blank" class="btn-grabfood">
                        {{ $data['order_online'] }}
                    </a>
                    @elseif($data['order_online'] == 'GO FOOD')
                    <a href="{{ $data['link_order'] }}" target="_blank" class="btn-gofood">
                        {{ $data['order_online'] }}
                    </a>
                    @else
                    <a href="{{ $data['link_order'] }}" target="_blank" class="btn-custom">
                        {{ $data['order_online'] }}
                    </a>
                    @endif
                    @else
                    <a href="{{ config('app.link_grabfood') }}" target="_blank" class="btn-grabfood">
                        Grab Food
                    </a>
                    &nbsp;&nbsp;
                    <a href="{{ config('app.link_gofood') }}" target="_blank" class="btn-gofood">
                        Go Food
                    </a>
                    @endif
                </div>
            </center>

        </p>

        <br />

        <div style='margin-top: 10px'>
            <p style='text-align:center; color: #000 !important'>
                This message is an automated message from {{ config('app.brand') }}
            </p>
        </div>
    </div>
    <br />
</div>
@endsection

@section('footer')
<p style='text-align:center'>
    Best Regards, <br /> <b>{{ config('app.brand') }}</b>
</p>
@endsection
