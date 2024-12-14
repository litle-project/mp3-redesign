<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data->nomor_rk}} (Surat Izin Cuti)</title>
    <style>
        .title{
            /* margin-top: 10px; */
        }
        .middle{
            margin-top: 40px;
            padding: 0px 20px;
        }
        .middle table tr td{
            /* padding: 10px 0px; */
        }
        .middle table tr td:first-child {
            /* padding: 10px 0px; */
            width: 39%;
        }
        .middle table tr td:last-child {
            /* padding: 10px 0px; */
            width: 60%;
        }
        .uppercase{
             text-transform: uppercase;
        }
        .footer{
             margin-top: 20px;
            padding: 0px 60px;
        }
    </style>
</head>

<body style='font-family: proxima-nova,"Helvetica Neue",Helvetica,Arial,sans-serif ' >
    <div class="header">
        <table>
            <tr>
                <td>
                    <img src="https://simlog.disnavpriok.id/assets/images/icon/kemenhub.png" height="130px" alt=""></td>
                <td style="vertical-align: top;">
                    <div style="padding-left:20px;width:100%">
                        <div>
                            <span style="font-size:2vw;font-size: 35px;display:block;font-weight:bolder; ">KEMENTERIAN PERHUBUNGAN</span>
                            <span style="font-size: 1vw;font-size:23px;display:block;font-weight:bolder; ">DIREKTORAT JENDERAL PERHUBUNGAN LAUT</span>
                            <span style="font-size: 1vw;font-size:24.5px;display:block;font-weight:bolder; ">DISTRIK NAVIGASI KELAS I TANJUNG PRIOK</span>
                        </div>
                        <div>
                            <table style="font-size:10px">
                                <tr>
                                    <td style="vertical-align: top;">
                                        <div style="margin-left:-4px">
                                            <table style="">
                                                <tr>
                                                    <td>Jl. Raya Ancol Baru, Tanjung Priok</td>
                                                </tr>
                                                <tr>
                                                    <td>Jakarta Utara , 14310</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td style="vertical-align: top;font-size:10px">
                                        <div style="padding-left: 10px;">
                                            <table style="">
                                                <tr>
                                                    <td>TELP</td>
                                                    <td style="white-space: nowrap">: (021) 4393, 0070</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td style="white-space: nowrap">: (021) 4393, 1849</td>
                                                </tr>
                                                <tr>
                                                    <td>FAX</td>
                                                    <td style="white-space: nowrap">: (021) 4393, 0534</td>
                                                </tr>

                                            </table>
                                        </div>
                                    </td>
                                    <td style="vertical-align: top;">
                                        <div style="padding-left:10px;">
                                            <table style="">
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('/images/icon/browser.png') }}" width="10" alt="">
                                                        {{-- <img src="{{ public_path('/images/icon/browser.png') }}"  width="10" alt=""> --}}
                                                    </td>
                                                    <td >: <span style="font-size: 10px">https://hubla.dephub.go.id/disnavtanjungpriok</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('/images/icon/mail.png') }}" width="10" alt="">
                                                        {{-- <img src="{{ public_path('/images/icon/mail.png') }}"  width="10" alt=""> --}}

                                                    </td>
                                                    <td>: disnavtanjungpriok@dephub.go.id</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="body" style="padding: 0px 30px;">
        <div class="main">
            {{-- <div class="top">
                <div style="text-align: right;">
                </div>
            </div> --}}

            <div class="title" >
                <div style="text-align: center;">
                    <span style="font-weight:bold;display:block;">SURAT IZIN CUTI</span>
                    <span style="font-weight:bold;">{{$data->nomor_permohonan}}</span>
                </div>
            </div>
            <div class="middle">
                Diberikan Cuti kepada Pegawai Distrik Navigasi Kelas I Tanjung Priok
                <br>
                <div>
                    <table style="width: 100%">
                        <tr>
                            <td>Nama</td>
                            <td style="width: 1%">:</td>
                            <td> {{$data->Users->name ?? null}}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td style="width: 1%">:</td>
                            <td> {{$data->Users->nip ?? null}}</td>
                        </tr>
                        <tr>
                            <td>Pangkat/Gol. Ruang</td>
                            <td style="width: 1%">:</td>
                            <td> {{$data->Users->Pangkats->nama_pangkat ?? null}}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td style="width: 1%">:</td>
                            <td> {{$data->Users->roles->first()->name ?? null}}</td>
                        </tr>
                        <tr>
                            <td>Satuan Organisasi</td>
                            <td style="width: 1%">:</td>
                            <td> Distrik Navigasi Kelas I Tanjung Priok</td>
                        </tr>

                    </table>
                </div>
                <div style="margin-top:37px;">
                    <span style="font-size:12px">Selama <strong>{{$data->total_hari_cuti}}</strong> hari kerja, terhitung mulai tanggal <strong>{{$data->tanggal_mulai_cuti}}</strong> s.d tanggal {{$data->total_selesai_cuti}} .
                    Selama menjalankan cuti , alamat yang bersangkutan adalah di <strong>{{$data->alamat_pemohon}}</strong> dengan ketentuan sebagai berikut :
                    </span>
                </div>
                <div style="margin-top:20px;font-size:14px">
                    <table>
                        <tr>
                            <td style="width: 1%;vertical-align: top;">a.</td>
                            <td>Sebelum menjalankan cuti wajib menyerahkan pekerjaan kepada atasan langsungnya.</td>
                        </tr>
                        <tr>
                            <td style="width: 1%;vertical-align: top;">b.</td>
                            <td>Setelah selesai menjalankan cuti wajib melaporkan diri kepada atasan langsungnya dan bekerja kembali sebagaimana mestinya.</td>
                        </tr>
                    </table>
                </div>
                <div style="margin-top:30px;">
                    <span>Demikian surat izin cuti ini dibuat untuk dapat digunakan sebagaimana mestinya</span>
                </div>

            </div>

        </div>
    </div>

    <div class="footer">
         <table style="">
                <tr>
                    <td style="width: auto;padding-right:10px;">
                        <div style="text-align: center;">
                            <div style="margin-bottom:18px;">
                                <span style="display: block;font-size: 12px;">Diketahui Oleh</span>
                            </div>

                            @if ($data->persetujuanCuti->where('role_to_name','Kabag Tata Usaha')->first())
                                {!! '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG(route('public-data.user',['id'=>$data->persetujuanCuti->where('role_to_name','Kabag Tata Usaha')->first()->user_id ?? 0,'title'=>'Atasan Langsung']), 'QRCODE',2.5,2.5) . '" alt="barcode"   />' !!}
                                <span style="display: block;font-size: 12px;">Atasan Langsung</span>
                                <span style="display: block;font-size: 10px;" >{{$data->persetujuanCuti->where('role_to_name','Kabag Tata Usaha')->first()->timestamp ?? '-'}}</span>
                            @else
                                <img src="{{asset('images/icon/nay.png')}}" height="72" alt="">
                                <span style="display: block;font-size: 12px;">Atasan Langsung</span>
                                <span style="display: block;font-size: 10px;" >{{$data->timestamp ?? '-'}}</span>
                            @endif

                        </div>
                    </td>
                    <td style="width: auto;padding-right:10px;">
                        <div style="text-align: center;">
                            <div style="margin-bottom:18px;">
                                <span style="display: block;font-size: 12px;">&nbsp;</span>
                            </div>

                            @if ($data->persetujuanCuti->where('role_to_name','Kepala Distrik Navigasi')->first())
                                {!! '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG(route('public-data.user',['id'=>$data->persetujuanCuti->where('role_to_name','Kepala Distrik Navigasi')->first()->user_id ?? 0,'title'=>'Kepala Bagian Tata Usaha']), 'QRCODE',2.5,2.5) . '" alt="barcode"   />' !!}
                                <span style="display: block;font-size: 12px;">Kepala Bagian Tata Usaha</span>
                                <span style="display: block;font-size: 10px;" >{{$data->persetujuanCuti->where('role_to_name','Kepala Distrik Navigasi')->first()->timestamp ?? '-'}}</span>
                            @else
                                <img src="{{asset('images/icon/nay.png')}}" height="72" alt="">
                                <span style="display: block;font-size: 12px;">Kepala Bagian Tata Usaha</span>
                                 <span style="display: block;font-size: 10px;" >{{$data->timestamp ?? '-'}}</span>
                            @endif

                        </div>
                    </td>
                    <td style="width: auto;padding-right:10px;">
                        <div style="text-align: center;">
                            <div style="margin-bottom:18px;">
                                <span style="display: block;font-size: 12px;">Disetujui</span>
                            </div>

                            @if ($data->persetujuanCuti->where('role_to_name','!=','Kepala Distrik Navigasi')->where('position','Kepala Distrik Navigasi')->first())
                                {!! '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG(route('public-data.user',['id'=>$data->persetujuanCuti->where('role_to_name','!=','Kepala Distrik Navigasi')->where('position','Kepala Distrik Navigasi')->first()->user_id ?? 0,'title'=>'Kepala Distrik Navigasi']), 'QRCODE',2.5,2.5) . '" alt="barcode"   />' !!}
                                <span style="display: block;font-size: 12px;">• Kepala Distrik Navigasi</span>
                                <span style="display: block;font-size: 10px;" >{{$data->persetujuanCuti->where('role_to_name','!=','Kepala Distrik Navigasi')->where('position','Kepala Distrik Navigasi')->first()->timestamp ?? '-'}}</span>
                            @else
                                <img src="{{asset('images/icon/nay.png')}}" height="72" alt="">
                                <span style="display: block;font-size: 12px;">• Kepala Distrik Navigasi</span>
                                 <span style="display: block;font-size: 10px;" >{{$data->timestamp ?? '-'}}</span>
                            @endif

                        </div>
                    </td>
                    {{-- <td style="width: auto;padding-right:10px;">
                        <div style="text-align: center;">
                            <div style="margin-bottom:18px;">
                                <span style="display: block;font-size: 12px;">Disetujui Oleh</span>
                            </div>

                            @if ($data->approvals->where('type','Disetujui Kadisnav')->first())
                                {!! '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG(route('public-data.user',$data->approvals->where('type','Disetujui Kadisnav')->first()->approve_by_id ?? 0), 'QRCODE',2.5,2.5) . '" alt="barcode"   />' !!}
                                <span style="display: block;font-size: 12px;">Kepala Distrik</span>
                                <span style="display: block;font-size: 12px;">Navigasi</span>
                                <span style="display: block;font-size: 10px;" >{{$data->approvals->where('type','Disetujui Kadisnav')->first()->timestamp ?? '-'}}</span>
                            @else
                                <img src="{{asset('images/icon/nay.png')}}" height="72" alt="">
                                <span style="display: block;font-size: 12px;">Kepala Distrik</span>
                                <span style="display: block;font-size: 12px;">Navigasi</span>
                                <span style="display: block;font-size: 10px;" >{{$data->tanggal_permintaan ?? '-'}}</span>
                            @endif

                        </div>
                    </td> --}}



                </tr>
            </table>
        <div class="left-note" style="padding: 0px 50px;margin-top:30px;margin-left:-60px">
            <span class="" style="display: block ;font-size:12px;"> Tembusan :</span>
            <span class="" style="display: block ;font-size:12px;">1. Kepala Bagian Tata Usaha Disnav Kelas I Tg. Priok</span>
            <span class="" style="display: block ;font-size:12px;">2. Kasubbag Keuangan Disnav Kelas I Tg Priok</span>
            <span class="" style="display: block ;font-size:12px;">3. Petugas Absensi</span>
        </div>
    </div>


</body>

</html>
