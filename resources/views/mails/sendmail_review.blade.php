@extends('mails.layout')

@section('content_email')
<div style="margin-top: 30px !important;margin-bottom: 20px">

    <div style="margin-top: 20px; padding: 20px 20px; border-bottom: 2px solid #fff;background: #F2F2F2; color: #5B5B5B">

        <h4 style="text-align:center; font-size: 18px; color: #000">
            {{ $data['title'] }}
        </h4>

        <p style="text-align:left; color: #000; font-size:16px">
            Hello {{ config('app.brand') }},
        </p>
        <p style="text-align:left; color: #000; font-size:16px">
            {{ $data['name'] }} telah memberi Ulasan pada tanggal {{ date_format(date_create(now()), 'd F, Y H:i A') }}
        </p>
        <p style="text-align:left; color: #000; font-size:16px">
            Detail ulasan sebagai berikut :
            <ul>
                <li>
                    Nama : {{ $data['name'] }}
                </li>
                <li>
                    Rating : ⭐ {{ $data['rate'] }}
                </li>
                <li>
                    Layanan : {{ $data['service'] }}
                </li>
                <li>
                    Ulasan : {{ $data['review'] }}
                </li>
            </ul>
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
