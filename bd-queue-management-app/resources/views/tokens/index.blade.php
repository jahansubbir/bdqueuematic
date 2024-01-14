@extends('layouts.navigation')


    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Todays Tokens
            </h2>

        </x-slot>
        <div class='container'>



            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">




                    <table class='table table-striped table-hover'>
                        <thead>
                            <tr>
                                <th>Counter</th>
                                <th>Token Type</th>
                                <th>Token No</th>
                                <th>Appointment Start</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resource as $type)
                            <tr>

                                <td>{{ $type->counter }}</td>
                                <td>{{$type->token_type}}</td>
                                <td>{{ $type->token_no }}</td>
                                <td>{{ $type->appointment_start }}</td>
                                <td> <a class="btn btn-success"
                                        href="{{ route('tokens.details', ['id' => $type->id]) }}">Details</a></td>
                                <td>
                                   

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </x-app-layout>

<script>
    $(document).ready(function () {
   
        $("button").click(function() {
            
    var id=this.id;
   
    var message=id+ "Counter Number 2";
    const utterance=new SpeechSynthesisUtterance(message);
    const voices=speechSynthesis
    .getVoices()
    .filter(voice => voice.lang === "en-GB");
    //alert(voices.length);
    utterance.voice=voices[1];
    window.speechSynthesis.speak(utterance);

});
        
    });
   
</script>