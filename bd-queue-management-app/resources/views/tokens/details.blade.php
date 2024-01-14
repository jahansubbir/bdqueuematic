@extends('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Token Details
        </h2>
    </x-slot>

    <div class='container' style='margin-top:100px;'>
        <div id="captureArea">
            <!-- Your webpage content goes here -->


            <div style='margin:0 auto;max-width:100%;'>

                <div class='card'>

                    <div class="card-body">
                        <h2 class="card-title">
                            <div class='row'>

                                <div class='col-sm-4'><b class="btn btn-info">Token No:<br />
                                        {{$resource->first()->token_no}}</b>
                                </div>
                                <div class='col-sm-6'><b class="btn btn-success">Tentative Serving Time:<br />
                                        {{$resource->first()->appointment_start}}</b>
                                </div>
                            </div>

                        </h2>
                        <p class="card-text">
                        <table class='table table-striped table-hover'>
                            <tr>
                                <th>
                                    Customer:
                                </th>
                                <td>
                                    {{$resource->first()->name}}
                                </td>
                            </tr>
                            <tr>
                                <th>CNF:</th>

                                <td> {{$resource->first()->cnf_name}}</td>

                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{ $resource->first()->contact_no }}</td>

                            </tr>

                            <tr>
                                <th>Counter:</td>
                                <td>{{ $resource->first()->counter }}</td>

                            </tr>
                            <tr>
                                <th>Token Type</td>
                                <td>{{ $resource->first()->token_type }}</td>
                            </tr>



                        </table>
                        </p>

                    </div>
                </div>
            </div>


            <div class='card' style='margin:0 auto;max-width:100%;'>
                <table class='table table-striped table-hover'>
                    <thead>
                        <tr>
                            <th>BL No</th>
                            <th>BE No</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resource as $r)
                        <tr>
                            <td>{{$r->bl_no}}</td>
                            <td>{{$r->be_no}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
          
        </div>
        <button id="captureButton" class='btn btn-success'>Download Token</button>
    </div>
    

</x-app-layout>
<script>
    document.getElementById('captureButton').addEventListener('click', function () {
        html2canvas(document.getElementById('captureArea')).then(function (canvas) {
            // Convert canvas to data URL
            var dataURL = canvas.toDataURL('image/png');

            // Create a link element and trigger a download
            var link = document.createElement('a');
            link.href = dataURL;
            link.download = 'webpage_capture.png';
            link.click();
        });
    });
</script>
