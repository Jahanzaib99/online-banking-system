@extends('frontend.layout.layout')
@section('content')
    <!-- ======= Hero Section ======= -->

    <div class="filter-product-reg">
        <h1>ENTER YOUR REG PLATE</h1>
        @if (session()->has('success'))
            <div class="alert alert-success">
                @if(is_array(session('success')))
                    <ul>
                        @foreach (session('success') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @else
                    {{ session('success') }}
                @endif
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{route('find.model')}}" name="registrationform">
            @csrf
            <div class="regno-box">
                <img src="{{asset('public/frontend/assets/img/european-union.svg')}}" alt="">
                <input type="text" name="registrationNumber" id="registrationNumber">
            </div>
            <div class="submit-section">
                <input type="submit" value="Submit">
            </div>
        </form>

    </div>

    <div class="fill-manual-data-container">
        <form class="find-part-section" method="get" action="{{route('partsfilter')}}">
            @csrf
            <h2 class="text-center">OR ENTER MANUALLY</h2>
            <select id="make" name="make" aria-placeholder="Select Make">
                <option value="">-- Select Make --</option>
                @foreach($make as $car_make)
                    <option value="{{$car_make->id}}">{{$car_make->name}}</option>
                @endforeach
            </select>
            <select id="model" name="model" aria-placeholder="Select Model">
                <option value="">-- Select Model --</option>
                @foreach($model as $car_model)
                    <option value="{{$car_model->id}}">{{$car_model->name}}</option>
                @endforeach
            </select>
            <select id="year" name="year" aria-placeholder="Select Year">
                <option value="">-- Select Year --</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
                <option value="2008">2008</option>
                <option value="2007">2007</option>
                <option value="2006">2006</option>
                <option value="2005">2005</option>
                <option value="2004">2004</option>
                <option value="2003">2003</option>
                <option value="2002">2002</option>
                <option value="2001">2001</option>
                <option value="2000">2000</option>
                <option value="1999">1999</option>
                <option value="1998">1998</option>
                <option value="1997">1997</option>
                <option value="1996">1996</option>
                <option value="1995">1995</option>
                <option value="1994">1994</option>
                <option value="1993">1993</option>
                <option value="1992">1992</option>
                <option value="1991">1991</option>
                <option value="1990">1990</option>
                <option value="1989">1989</option>
                <option value="1988">1988</option>
                <option value="1987">1987</option>
                <option value="1986">1986</option>
                <option value="1985">1985</option>
                <option value="1984">1984</option>
                <option value="1983">1983</option>
                <option value="1982">1982</option>
                <option value="1981">1981</option>
                <option value="1980">1980</option>
                <option value="1979">1979</option>
                <option value="1978">1978</option>
                <option value="1977">1977</option>
                <option value="1976">1976</option>
                <option value="1975">1975</option>
                <option value="1974">1974</option>
                <option value="1973">1973</option>
                <option value="1972">1972</option>
                <option value="1971">1971</option>
                <option value="1970">1970</option>
                <option value="1969">1969</option>
                <option value="1968">1968</option>
                <option value="1967">1967</option>
                <option value="1966">1966</option>
                <option value="1965">1965</option>
                <option value="1964">1964</option>
                <option value="1963">1963</option>
                <option value="1962">1962</option>
                <option value="1961">1961</option>
                <option value="1960">1960</option>
            </select>
            <input type="text" id="body" name="body2" placeholder="Body">
            <input type="text" id="engine" name="engine2" placeholder="Engine">
            <input type="text" id="fuel" name="Fuel2" placeholder="Fuel">
            <input type="text" id="trim" name="trim2" placeholder="Trim">
            <input type="text" id="gearbox" name="gearbox2" placeholder="gearbox">
            <div class="submit-section">
                <input type="submit" value="Submit">
            </div>

        </form>
    </div>
@endsection

