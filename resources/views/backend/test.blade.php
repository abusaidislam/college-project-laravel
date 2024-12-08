<div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table id="datatable-responsive" class="table table-striped table-bordered nowrap" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Year of exam</th>
                            {{-- <th>Class Of Year</th> --}}
                            <th>Class Year</th>
                            <th>Name</th>
                            <th>Reg No</th>
                            <th>Roll No</th>
                            @foreach ($Course as $v)
                                {{-- <th>{{ $v->course_code }}({{$v->name}})</th> --}}
                                <th>{{ $v->course_code }}</th>
                            @endforeach
                            <th>Download(PDF,Excel)</th>

                        </tr>
                    </thead>
                    <tbody id="list">
                        StudentResult
                        @foreach ($Student as $ndata)
                            @php
                                $studentdata = DB::table('students')
                                    ->where('id', $ndata->stu_id)
                                    ->first();
                                $studentclassList = DB::table('student_results')
                                    ->where('depart_id', $depart_id)
                                    ->where('student_id', $ndata->stu_id)
                                    ->where('class_id', $ndata->class_name)
                                    ->orderby('subject', 'asc')
                                    ->get();
                                $studentClassYear = DB::table('student_results')
                                    ->where('depart_id', $depart_id)
                                    ->where('student_id', $ndata->stu_id)
                                    ->where('class_id', $ndata->class_name)
                                    ->orderby('subject', 'asc')
                                    ->first();
                                $studentClassName = DB::table('studen_classes')
                                    ->where('id', $ndata->class_name)
                                    ->first();
                            @endphp
                            {{-- @dd($studentdata); --}}

                            <tr>
                                <td>{{ $loop->index }}</td>
                                <td>{{ $studentClassYear ? $studentClassYear->years : '' }}</td>
                                <td>{{ $studentClassName ? $studentClassName->name : '' }}</td>
                                <td>{{ $studentClassYear ? $studentClassYear->student_class_year : '' }}</td>
                                <td>{{ $ndata->name }}</td>
                                <td>{{ $ndata->roll }}</td>
                                <td>{{ $ndata->registration_no }}</td>

                                @foreach ($Course as $v)
                                    @php
                                        $found = $studentclassList->firstWhere('subject', $v->id);
                                        $marks = $found ? $found->marks : '';
                                    @endphp
                                    <td>
                                        {{ $marks }}
                                    </td>
                                @endforeach
                                <td>
                                    <button type="button" id="edit" data-id="{{ $ndata->id }}"
                                        class="btn btn-sm btn-info">Edit</button>
                                    <a target="_blank" href="{{ url('mark-sheet-download', $ndata->id) }}"
                                        class="btn btn-sm btn-primary">Download</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
