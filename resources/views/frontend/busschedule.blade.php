<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layouts.master')
    @section('content')
        <div class=" bg-white">
            <div class="row px-3 pb-5">
                <table class="table table-striped table-bordered " cellspacing="0">
                    <center>
                        <h3 class="p-3">Bus Schedule</h3>
                    </center>
                    <thead>
                        <tr>
                            @foreach ($bus_terminals as $nbus_terminals)
                                <th>{{ $nbus_terminals->space_name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $ndata)
                            <tr>
                                <td>
                                    @if ($ndata->sokhipur != 0)
                                        {{ $ndata->bus_no }}){{ $ndata->sokhipur }}
                                    @endif
                                </td>
                                <td>
                                    @if ($ndata->gorai != 0)
                                        {{ $ndata->bus_no }}){{ $ndata->gorai }}
                                    @endif
                                </td>
                                <td>
                                    @if ($ndata->mirjapur != 0)
                                        {{ $ndata->bus_no }}){{ $ndata->mirjapur }}
                                    @endif
                                </td>
                                <td>
                                    @if ($ndata->elenga != 0)
                                        {{ $ndata->bus_no }}){{ $ndata->elenga }}
                                    @endif
                                </td>
                                <td>
                                    @if ($ndata->notunbusstand != 0)
                                        {{ $ndata->bus_no }}){{ $ndata->notunbusstand }}
                                    @endif
                                </td>
                                <td>
                                    @if ($ndata->puratonbusstand != 0)
                                        {{ $ndata->bus_no }}){{ $ndata->puratonbusstand }}
                                    @endif
                                </td>
                                <td>
                                    @if ($ndata->college != 0)
                                        {{ $ndata->bus_no }}){{ $ndata->college }}
                                    @endif
                                </td>
                                <td>
                                    @if ($ndata->note != 0)
                                        {{ $ndata->bus_no }}){{ $ndata->note }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
