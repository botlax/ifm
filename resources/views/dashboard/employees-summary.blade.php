@extends('dashboard')

@section('css')
<link rel="stylesheet" href="{{url('/')}}/assets/css/print.css" />
@endsection

@section('title')
Employees | {{config('app.name')}}
@endsection

@section('header')

@include('dashboard.partials.header')

@endsection

@section('content')

@component('dashboard.partials.nav-panel')
	@slot('empClass')
		active
	@endslot
@endcomponent


@component('dashboard.partials.content')
	@slot('headerFA')
		users
	@endslot
	@slot('headerTitle')
		Employees
	@endslot
	@slot('content')
		<div id="heading" class="nh ps">
		<h4>INTERNATIONAL FACILITY MANAGEMENT</h4>
		<h5>MANPOWER UPDATE LIST</h5>
		</div>
		<div id="tools" class="ph">
			{!! Form::open(['method' => 'GET','route' => 'emp-search','id' => 'searchForm']) !!}
				{!! Form::text('q','') !!}
				{!! Form::select('position',['' => '--Select Position--',
                    'Accountant'  =>  'Accountant',
		    'AC Technician' => 'AC Technician',
                    'Administration Manager'   =>  'Administration Manager',
                    'Assist. Accountant'  =>  'Assist. Accountant',
                    'Assist. Foreman'  =>  'Assist. Foreman',
                    'Block Mason' =>  'Block Mason',
                    'Camp Boss'   =>  'Camp Boss',
                    'Camp Cleaner' =>  'Camp Cleaner',
                    'Camp Security'  =>  'Camp Security',
                    'Civil Engineer'   =>  'Civil Engineer',
                    'Contracts Manager'   =>  'Contracts Manager',
                    'Decorative Painter'  =>  'Decorative Painter',
                    'Draftsman'    =>  'Draftsman',
                    'Plumber'  =>  'Plumber',
                    'Electrician'  =>  'Electrician',
                    'Equipment Operator'   =>  'Equipment Operator',
                    'Executive Manager'   =>  'Executive Manager',
                    'Finance Manager' => 'Finance Manager',
                    'Foreman' => 'Foreman',
                    'General Manager'   =>  'General Manager',
                    'General Service Assistant'   =>  'General Service Assistant',
                    'General Service Manager'   =>  'General Service Manager',
                    'Head Of Tender Department'   =>  'Head Of Tender Department',
                    'Heavy Driver'  =>  'Heavy Driver',
                    'HR Manager'   =>  'HR Manager',
                    'HR Officer'   =>  'HR Officer',
                    'In-charge, Steel Fixer Grp' =>  'In-charge, Steel Fixer Grp',
                    'In-charge, Painter Grp' =>  'In-charge, Painter Grp',
                    'In-charge, Mason Grp' =>  'In-charge, Mason Grp',
                    'JCB Operator' =>  'JCB Operator',
                    'Labourer'   =>  'Labourer',
                    'Leadman'    =>  'Leadman',
                    'Light Driver'    =>  'Light Driver',
                    'Male Nurse'  =>  'Male Nurse',
                    'Mason'    =>  'Mason',
                    'Mechanic'  =>  'Mechanic',
                    'Mechanic Assistant' =>  'Mechanic Assistant',
                    'Office Boy'   =>  'Office Boy',
                    'Office Security'  =>  'Office Security',
                    'Operations Manager'   =>  'Operations Manager',
                    'Painter' =>  'Painter',
                    'Plumber' =>  'Plumber',
                    'Project Engineer'    =>  'Project Engineer',
                    'Project Manager'   =>  'Project Manager',
                    'Public Relation Manager'    =>  'Public Relation Manager',
                    'Public Relation Officer'    =>  'Public Relation Officer',
                    'Purchase Engineer'   =>  'Purchase Engineer',
                    'Purchase Manager'   =>  'Purchase Manager',
                    'Purchase Representative' =>  'Purchase Representative',
                    'QS / Estimator'  =>  'QS / Estimator',
                    'Representative' => 'Representative',
                    'Safety Assist.'   =>  'Safety Assist.',
                    'Safety Officer'   =>  'Safety Officer',
                    'Secretary'    =>  'Secretary',
                    'Secretary/IT Assistant'    =>  'Secretary/IT Assistant',
                    'Shutter Carpenter'    =>  'Shutter Carpenter',
                    'Site Engineer'    =>  'Site Engineer',
                    'Steel Fixer'   =>  'Steel Fixer',
                    'Store Kepeer'    =>  'Store Kepeer',
                    'Technical Engineer' =>  'Technical Engineer',
                    'Timekeeper'   =>  'Timekeeper',
                    'Watchman' =>  'Watchman']) !!}
                    {!! Form::select('nationality',$nats) !!}

                    <div class="field-wrap">
                    	<label for="empnum"><input type="checkbox" name="fields[]" value="empnum" id="empnum" {{ in_array('empnum',session('fields'))?'checked':'' }}>Employee ID</label>

                    	<label for="dob"><input type="checkbox" name="fields[]" value="dob" id="dob" {{ in_array('dob',session('fields'))?'checked':'' }}>Date of Birth</label>

                    	<label for="nat"><input type="checkbox" name="fields[]" value="nat" id="nat" {{ in_array('nat',session('fields'))?'checked':'' }}>Nationality</label>

                    	<label for="jd"><input type="checkbox" name="fields[]" value="jd" id="jd" {{ in_array('jd',session('fields'))?'checked':'' }}>Join Date</label>

                    	<label for="qid"><input type="checkbox" name="fields[]" value="qid" id="qid" {{ in_array('qid',session('fields'))?'checked':'' }}>QID</label>

                    	<label for="passport"><input type="checkbox" name="fields[]" value="passport" id="passport" {{ in_array('passport',session('fields'))?'checked':'' }}>Passport</label>

                    	<label for="hc"><input type="checkbox" name="fields[]" value="hc" id="hc" {{ in_array('hc',session('fields'))?'checked':'' }}>Health Card</label>

                    	<label for="salary"><input type="checkbox" name="fields[]" value="salary" id="salary" {{ in_array('salary',session('fields'))?'checked':'' }}>Salary</label>
                    </div>
				{!! Form::submit('search') !!}
			{!! Form::close() !!}

			<a href="#" class="adv-search-toggle">Advance Search</a>
			<div id="adv-search">
			{!! Form::open(['method' => 'GET','route' => 'emp-advsearch','id' => 'searchForm']) !!}
				{!! Form::label('adj', 'Employees ') !!}
				{!! Form::select('adj',['' => '--Select--', '1' => 'with', '0' => 'without']) !!}

				{!! Form::select('attr',['' => '--Select Attribute--', 'photo' => 'Photo', 'cv' => 'CV', 'contract' => 'Contract', 'qid' => 'QID', 'passport' => 'Passport', 'visa' => 'Visa', 'job_offer' => 'Job Offer', 'blood_group' => 'Blood Group','license' => 'License', 'salary' => 'Salary Details']) !!}
				<div class="field-wrap">
                	<label for="a-empnum"><input type="checkbox" name="fields[]" value="empnum" id="a-empnum" {{ in_array('empnum',session('fields'))?'checked':'' }}>Employee ID</label>

                	<label for="a-dob"><input type="checkbox" name="fields[]" value="dob" id="a-dob" {{ in_array('dob',session('fields'))?'checked':'' }}>Date of Birth</label>

                	<label for="a-nat"><input type="checkbox" name="fields[]" value="nat" id="a-nat" {{ in_array('nat',session('fields'))?'checked':'' }}>Nationality</label>

                	<label for="a-jd"><input type="checkbox" name="fields[]" value="jd" id="a-jd" {{ in_array('jd',session('fields'))?'checked':'' }}>Join Date</label>

                	<label for="a-qid"><input type="checkbox" name="fields[]" value="qid" id="a-qid" {{ in_array('qid',session('fields'))?'checked':'' }}>QID</label>

                	<label for="a-passport"><input type="checkbox" name="fields[]" value="passport" id="passport" {{ in_array('passport',session('fields'))?'checked':'' }}>Passport</label>

                	<label for="a-hc"><input type="checkbox" name="fields[]" value="hc" id="a-hc" {{ in_array('hc',session('fields'))?'checked':'' }}>Health Card</label>

                	<label for="a-salary"><input type="checkbox" name="fields[]" value="salary" id="a-salary" {{ in_array('salary',session('fields'))?'checked':'' }}>Salary</label>
                </div>
				{!! Form::submit('search') !!}
			{!! Form::close() !!}
			</div>
			
			<a href="{{url('employees')}}">All</a>
			<a href="{{url('cancelled')}}">Cancelled Employees</a>
			<a href="{{url('employees/summary')}}">Manpower Report</a>
			<a href="{{url('employees/add')}}"><i class="fa fa-plus"></i>Add Employee</a>
		</div>
		
		<table id="summary">
			<thead>
  				<tr>
				    <th rowspan="2">S.NO.</th>
				    <th rowspan="2">Designation</th>
				    <th rowspan="2">Total</th>
				    <th rowspan="2">On Duty</th>
				    <th rowspan="2">On Vacation</th>
				    <th colspan="10">Nationalities of Existing Human Capital</th>
  				</tr>

  				<tr>
				    <th>PAL</th>
				    <th>JOR</th>
				    <th>PAK</th>
				    <th>EGP</th>
				    <th>IND</th>
				    <th>NEP</th>
				    <th>PHI</th>
				    <th>SRL</th>
				    <th>BAN</th>
				    <th>TOTAL</th>
  				</tr>
			</thead>
			<tbody>
				<?php $x=1; ?>
				@foreach($total as $key => $val)
				<tr>
					<td>{{$x}}</td>
					<td>{{strtoupper($key)}}</td>
					<td>{{$val}}</td>
					<td>{{$duty[$key]}}</td>
					<td>{{$vac[$key]}}</td>

					<td>{{$pal[$key]}}</td>
					<td>{{$jor[$key]}}</td>
					<td>{{$pak[$key]}}</td>
					<td>{{$egp[$key]}}</td>
					<td>{{$ind[$key]}}</td>
					<td>{{$nep[$key]}}</td>
					<td>{{$phi[$key]}}</td>
					<td>{{$srl[$key]}}</td>
					<td>{{$ban[$key]}}</td>
					<th></th>
				</tr>
				<?php $x++; ?>
				@endforeach
				<tr>
					<th colspan="2">Total</th>
					<th>{{array_sum($total)}}</th>
					<th>{{array_sum($duty)}}</th>
					<th>{{array_sum($vac)}}</th>

					<th>{{array_sum($pal)}}</th>
					<th>{{array_sum($jor)}}</th>
					<th>{{array_sum($pak)}}</th>
					<th>{{array_sum($egp)}}</th>
					<th>{{array_sum($ind)}}</th>
					<th>{{array_sum($nep)}}</th>
					<th>{{array_sum($phi)}}</th>
					<th>{{array_sum($srl)}}</th>
					<th>{{array_sum($ban)}}</th>
					<th>{{array_sum($ban)+array_sum($srl)+array_sum($phi)+array_sum($nep)+array_sum($ind)+array_sum($egp)+array_sum($pak)+array_sum($jor)+array_sum($pal)}}</th>
				</tr>
			</tbody>
		</table>
		
	@endslot
@endcomponent

@endsection

@section('modal')

@endsection

@section('script')
	
@endsection
