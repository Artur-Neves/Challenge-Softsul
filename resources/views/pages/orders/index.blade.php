@extends('templates.page')
@section('content')
    <div class="container d-flex flex-column justify-content-between gap-4  border border-2">
        <div class="text-apresentation border-2 flex justify-center text-center border border-3 ">
            <h1>Artur Neves Almeida</h1>
            <div class="contact-icons d-flex flex-wrap justify-content-center gap-2">
                <a href="https://github.com/Artur-Neves" target="_blank" rel="noopener noreferrer">
                    <img src="https://img.shields.io/badge/-GitHub-%23181717?style=for-the-badge&logo=github&logoColor=white"
                        alt="GitHub">
                </a>
                <a href="https://www.linkedin.com/in/artur-neves-dev/" target="_blank" rel="noopener noreferrer">
                    <img src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&width=300px&logo=linkedin&logoColor=white"
                        alt="LinkedIn">
                </a>
                <a href="https://api.whatsapp.com/send/?phone=557388180562&text&type=phone_number&app_absent=0"
                    target="_blank" rel="noopener noreferrer">
                    <img src="https://img.shields.io/badge/-WhatsApp-%2325D366?style=for-the-badge&logo=whatsapp&logoColor=white"
                        alt="WhatsApp">
                </a>
                <a href="mailto:nevesdev.ti@gmail.com" target="_blank" rel="noopener noreferrer">
                    <img src="https://img.shields.io/badge/-Gmail-%23D14836?style=for-the-badge&logo=gmail&logoColor=white"
                        alt="Email">
                </a>
            </div>

        </div>

        <div class="table-orders flex border border-danger">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xxl-12">
                    <div class="card" id="card-users">
                        <div class="card-body px-2 p-xxl-3">
                            <div class="table-responsive table-responsive-xxl mt-0">
                                <table id="tableOrders"
                                    class="table-hover display nowrap table table-borderless stripe display full-width">

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
