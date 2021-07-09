@extends('authentication.layout.layout')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-10 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <img src="{{asset('public/frontend/assets/img/logo-2.png')}}" alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>Join us as supplier with SpareCarParts</span>
                                    </h6>
                                </div>
                                @if ($errors->any())

                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="post" class="form-horizontal" action="{{route('supplier.register')}}" novalidate>
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="trade_name">Trade Name *</label>
                                                        <input type="text" name="trade_name" class="form-control input-lg" id="trade_name" placeholder="Trade name"
                                                               tabindex="1" required data-validation-required-message="Please enter trade name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contact_name">Contact Name</label>
                                                        <input type="text" name="contact_name" class="form-control input-lg" id="contact_name" placeholder="Your contact name"
                                                               tabindex="1" required data-validation-required-message="Please enter contact name.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contact_tel">Contact Tel *</label>
                                                        <input type="text" name="contact_tel" class="form-control input-lg" id="contact_tel" placeholder="Your contact telephone"
                                                               tabindex="1" required data-validation-required-message="Please enter contact telephone.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contact_email">Contact email</label>
                                                        <input type="text" name="email" class="form-control input-lg" id="contact_email" placeholder="Your contact email"
                                                               tabindex="1" required data-validation-required-message="Please enter your email.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address_1">Address 1</label>
                                                        <input type="text" name="address_1" class="form-control input-lg" id="address_1" placeholder="Your address 1"
                                                               tabindex="1" required data-validation-required-message="Please enter address 1.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address_2">Address 2</label>
                                                        <input type="text" name="address_2" class="form-control input-lg" id="address_2" placeholder="Your address 2"
                                                               tabindex="1" required data-validation-required-message="Please enter address 2.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="post_town">Post Town</label>
                                                        <input type="text" name="post_town" class="form-control input-lg" id="post_town" placeholder="Your post town"
                                                               tabindex="1" required data-validation-required-message="Please enter your post town.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="county">County</label>
                                                        <input type="text" name="county" class="form-control input-lg" id="county" placeholder="Your county"
                                                               tabindex="1" required data-validation-required-message="Please enter your county.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Country</label>
                                                        <select name="country" id="country" class="form-control input-lg">
                                                            <option value=""></option>
                                                            <option value="AFGHANISTAN">AFGHANISTAN</option>
                                                            <option value="ALAND ISLANDS">ALAND ISLANDS</option>
                                                            <option value="ALBANIA">ALBANIA</option>
                                                            <option value="ALGERIA">ALGERIA</option>
                                                            <option value="AMERICAN SAMOA">AMERICAN SAMOA</option>
                                                            <option value="ANDORRA">ANDORRA</option>
                                                            <option value="ANGOLA">ANGOLA</option>
                                                            <option value="ANGUILLA">ANGUILLA</option>
                                                            <option value="ANTARCTICA">ANTARCTICA</option>
                                                            <option value="ANTIGUA AND BARBUDA">ANTIGUA AND BARBUDA</option>
                                                            <option value="ARGENTINA">ARGENTINA</option>
                                                            <option value="ARMENIA">ARMENIA</option>
                                                            <option value="ARUBA">ARUBA</option>
                                                            <option value="AUSTRALIA">AUSTRALIA</option>
                                                            <option value="AUSTRIA">AUSTRIA</option>
                                                            <option value="AZERBAIJAN">AZERBAIJAN</option>
                                                            <option value="BAHAMAS">BAHAMAS</option>
                                                            <option value="BAHRAIN">BAHRAIN</option>
                                                            <option value="BANGLADESH">BANGLADESH</option>
                                                            <option value="BARBADOS">BARBADOS</option>
                                                            <option value="BELARUS">BELARUS</option>
                                                            <option value="BELGIUM">BELGIUM</option>
                                                            <option value="BELIZE">BELIZE</option>
                                                            <option value="BENIN">BENIN</option>
                                                            <option value="BERMUDA">BERMUDA</option>
                                                            <option value="BHUTAN">BHUTAN</option>
                                                            <option value="BOLIVIA, PLURINATIONAL STATE OF">BOLIVIA, PLURINATIONAL STATE OF</option>
                                                            <option value="BONAIRE, SINT EUSTATIUS AND SABA">BONAIRE, SINT EUSTATIUS AND SABA</option>
                                                            <option value="BOSNIA AND HERZEGOVINA">BOSNIA AND HERZEGOVINA</option>
                                                            <option value="BOTSWANA">BOTSWANA</option>
                                                            <option value="BOUVET ISLAND">BOUVET ISLAND</option>
                                                            <option value="BRAZIL">BRAZIL</option>
                                                            <option value="BRITISH INDIAN OCEAN TERRITORY">BRITISH INDIAN OCEAN TERRITORY</option>
                                                            <option value="BRUNEI DARUSSALAM">BRUNEI DARUSSALAM</option>
                                                            <option value="BULGARIA">BULGARIA</option>
                                                            <option value="BURKINA FASO">BURKINA FASO</option>
                                                            <option value="BURUNDI">BURUNDI</option>
                                                            <option value="CAMBODIA">CAMBODIA</option>
                                                            <option value="CAMEROON">CAMEROON</option>
                                                            <option value="CANADA">CANADA</option>
                                                            <option value="CAPE VERDE">CAPE VERDE</option>
                                                            <option value="CAYMAN ISLANDS">CAYMAN ISLANDS</option>
                                                            <option value="CENTRAL AFRICAN REPUBLIC">CENTRAL AFRICAN REPUBLIC</option>
                                                            <option value="CHAD">CHAD</option>
                                                            <option value="CHILE">CHILE</option>
                                                            <option value="CHINA">CHINA</option>
                                                            <option value="CHRISTMAS ISLAND">CHRISTMAS ISLAND</option>
                                                            <option value="COCOS (KEELING) ISLANDS">COCOS (KEELING) ISLANDS</option>
                                                            <option value="COLOMBIA">COLOMBIA</option>
                                                            <option value="COMOROS">COMOROS</option>
                                                            <option value="CONGO">CONGO</option>
                                                            <option value="CONGO, THE DEMOCRATIC REPUBLIC OF THE">CONGO, THE DEMOCRATIC REPUBLIC OF THE</option>
                                                            <option value="COOK ISLANDS">COOK ISLANDS</option>
                                                            <option value="COSTA RICA">COSTA RICA</option>
                                                            <option value="COTE D'IVOIRE">COTE D'IVOIRE</option>
                                                            <option value="CROATIA">CROATIA</option>
                                                            <option value="CUBA">CUBA</option>
                                                            <option value="CURACAO">CURACAO</option>
                                                            <option value="CYPRUS">CYPRUS</option>
                                                            <option value="CZECH REPUBLIC">CZECH REPUBLIC</option>
                                                            <option value="DENMARK">DENMARK</option>
                                                            <option value="DJIBOUTI">DJIBOUTI</option>
                                                            <option value="DOMINICA">DOMINICA</option>
                                                            <option value="DOMINICAN REPUBLIC">DOMINICAN REPUBLIC</option>
                                                            <option value="ECUADOR">ECUADOR</option>
                                                            <option value="EGYPT">EGYPT</option>
                                                            <option value="EL SALVADOR">EL SALVADOR</option>
                                                            <option value="EQUATORIAL GUINEA">EQUATORIAL GUINEA</option>
                                                            <option value="ERITREA">ERITREA</option>
                                                            <option value="ESTONIA">ESTONIA</option>
                                                            <option value="ETHIOPIA">ETHIOPIA</option>
                                                            <option value="FALKLAND ISLANDS (MALVINAS)">FALKLAND ISLANDS (MALVINAS)</option>
                                                            <option value="FAROE ISLANDS">FAROE ISLANDS</option>
                                                            <option value="FIJI">FIJI</option>
                                                            <option value="FINLAND">FINLAND</option>
                                                            <option value="FRANCE">FRANCE</option>
                                                            <option value="FRENCH GUIANA">FRENCH GUIANA</option>
                                                            <option value="FRENCH POLYNESIA">FRENCH POLYNESIA</option>
                                                            <option value="FRENCH SOUTHERN TERRITORIES">FRENCH SOUTHERN TERRITORIES</option>
                                                            <option value="GABON">GABON</option>
                                                            <option value="GAMBIA">GAMBIA</option>
                                                            <option value="GEORGIA">GEORGIA</option>
                                                            <option value="GERMANY">GERMANY</option>
                                                            <option value="GHANA">GHANA</option>
                                                            <option value="GIBRALTAR">GIBRALTAR</option>
                                                            <option value="GREECE">GREECE</option>
                                                            <option value="GREENLAND">GREENLAND</option>
                                                            <option value="GRENADA">GRENADA</option>
                                                            <option value="GUADELOUPE">GUADELOUPE</option>
                                                            <option value="GUAM">GUAM</option>
                                                            <option value="GUATEMALA">GUATEMALA</option>
                                                            <option value="GUERNSEY">GUERNSEY</option>
                                                            <option value="GUINEA">GUINEA</option>
                                                            <option value="GUINEA-BISSAU">GUINEA-BISSAU</option>
                                                            <option value="GUYANA">GUYANA</option>
                                                            <option value="HAITI">HAITI</option>
                                                            <option value="HEARD ISLAND AND MCDONALD ISLANDS">HEARD ISLAND AND MCDONALD ISLANDS</option>
                                                            <option value="HOLY SEE (VATICAN CITY STATE)">HOLY SEE (VATICAN CITY STATE)</option>
                                                            <option value="HONDURAS">HONDURAS</option>
                                                            <option value="HONG KONG">HONG KONG</option>
                                                            <option value="HUNGARY">HUNGARY</option>
                                                            <option value="ICELAND">ICELAND</option>
                                                            <option value="INDIA">INDIA</option>
                                                            <option value="INDONESIA">INDONESIA</option>
                                                            <option value="IRAN, ISLAMIC REPUBLIC OF">IRAN, ISLAMIC REPUBLIC OF</option>
                                                            <option value="IRAQ">IRAQ</option>
                                                            <option value="IRELAND">IRELAND</option>
                                                            <option value="ISLE OF MAN">ISLE OF MAN</option>
                                                            <option value="ISRAEL">ISRAEL</option>
                                                            <option value="ITALY">ITALY</option>
                                                            <option value="JAMAICA">JAMAICA</option>
                                                            <option value="JAPAN">JAPAN</option>
                                                            <option value="JERSEY">JERSEY</option>
                                                            <option value="JORDAN">JORDAN</option>
                                                            <option value="KAZAKHSTAN">KAZAKHSTAN</option>
                                                            <option value="KENYA">KENYA</option>
                                                            <option value="KIRIBATI">KIRIBATI</option>
                                                            <option value="KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF">KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF</option>
                                                            <option value="KOREA, REPUBLIC OF">KOREA, REPUBLIC OF</option>
                                                            <option value="KUWAIT">KUWAIT</option>
                                                            <option value="KYRGYZSTAN">KYRGYZSTAN</option>
                                                            <option value="LAO PEOPLE'S DEMOCRATIC REPUBLIC">LAO PEOPLE'S DEMOCRATIC REPUBLIC</option>
                                                            <option value="LATVIA">LATVIA</option>
                                                            <option value="LEBANON">LEBANON</option>
                                                            <option value="LESOTHO">LESOTHO</option>
                                                            <option value="LIBERIA">LIBERIA</option>
                                                            <option value="LIBYA">LIBYA</option>
                                                            <option value="LIECHTENSTEIN">LIECHTENSTEIN</option>
                                                            <option value="LITHUANIA">LITHUANIA</option>
                                                            <option value="LUXEMBOURG">LUXEMBOURG</option>
                                                            <option value="MACAO">MACAO</option>
                                                            <option value="MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF">MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF</option>
                                                            <option value="MADAGASCAR">MADAGASCAR</option>
                                                            <option value="MALAWI">MALAWI</option>
                                                            <option value="MALAYSIA">MALAYSIA</option>
                                                            <option value="MALDIVES">MALDIVES</option>
                                                            <option value="MALI">MALI</option>
                                                            <option value="MALTA">MALTA</option>
                                                            <option value="MARSHALL ISLANDS">MARSHALL ISLANDS</option>
                                                            <option value="MARTINIQUE">MARTINIQUE</option>
                                                            <option value="MAURITANIA">MAURITANIA</option>
                                                            <option value="MAURITIUS">MAURITIUS</option>
                                                            <option value="MAYOTTE">MAYOTTE</option>
                                                            <option value="MEXICO">MEXICO</option>
                                                            <option value="MICRONESIA, FEDERATED STATES OF">MICRONESIA, FEDERATED STATES OF</option>
                                                            <option value="MOLDOVA, REPUBLIC OF">MOLDOVA, REPUBLIC OF</option>
                                                            <option value="MONACO">MONACO</option>
                                                            <option value="MONGOLIA">MONGOLIA</option>
                                                            <option value="MONTENEGRO">MONTENEGRO</option>
                                                            <option value="MONTSERRAT">MONTSERRAT</option>
                                                            <option value="MOROCCO">MOROCCO</option>
                                                            <option value="MOZAMBIQUE">MOZAMBIQUE</option>
                                                            <option value="MYANMAR">MYANMAR</option>
                                                            <option value="NAMIBIA">NAMIBIA</option>
                                                            <option value="NAURU">NAURU</option>
                                                            <option value="NEPAL">NEPAL</option>
                                                            <option value="NETHERLANDS">NETHERLANDS</option>
                                                            <option value="NEW CALEDONIA">NEW CALEDONIA</option>
                                                            <option value="NEW ZEALAND">NEW ZEALAND</option>
                                                            <option value="NICARAGUA">NICARAGUA</option>
                                                            <option value="NIGER">NIGER</option>
                                                            <option value="NIGERIA">NIGERIA</option>
                                                            <option value="NIUE">NIUE</option>
                                                            <option value="NORFOLK ISLAND">NORFOLK ISLAND</option>
                                                            <option value="NORTHERN MARIANA ISLANDS">NORTHERN MARIANA ISLANDS</option>
                                                            <option value="NORWAY">NORWAY</option>
                                                            <option value="OMAN">OMAN</option>
                                                            <option value="PAKISTAN">PAKISTAN</option>
                                                            <option value="PALAU">PALAU</option>
                                                            <option value="PALESTINIAN, STATE OF">PALESTINIAN, STATE OF</option>
                                                            <option value="PANAMA">PANAMA</option>
                                                            <option value="PAPUA NEW GUINEA">PAPUA NEW GUINEA</option>
                                                            <option value="PARAGUAY">PARAGUAY</option>
                                                            <option value="PERU">PERU</option>
                                                            <option value="PHILIPPINES">PHILIPPINES</option>
                                                            <option value="PITCAIRN">PITCAIRN</option>
                                                            <option value="POLAND">POLAND</option>
                                                            <option value="PORTUGAL">PORTUGAL</option>
                                                            <option value="PUERTO RICO">PUERTO RICO</option>
                                                            <option value="QATAR">QATAR</option>
                                                            <option value="REUNION">REUNION</option>
                                                            <option value="ROMANIA">ROMANIA</option>
                                                            <option value="RUSSIAN FEDERATION">RUSSIAN FEDERATION</option>
                                                            <option value="RWANDA">RWANDA</option>
                                                            <option value="SAINT BARTHELEMY">SAINT BARTHELEMY</option>
                                                            <option value="SAINT HELENA, ASCENSION AND TRISTAN DA CUNHA">SAINT HELENA, ASCENSION AND TRISTAN DA CUNHA</option>
                                                            <option value="SAINT KITTS AND NEVIS">SAINT KITTS AND NEVIS</option>
                                                            <option value="SAINT LUCIA">SAINT LUCIA</option>
                                                            <option value="SAINT MARTIN (FRENCH PART)">SAINT MARTIN (FRENCH PART)</option>
                                                            <option value="SAINT PIERRE AND MIQUELON">SAINT PIERRE AND MIQUELON</option>
                                                            <option value="SAINT VINCENT AND THE GRENADINES">SAINT VINCENT AND THE GRENADINES</option>
                                                            <option value="SAMOA">SAMOA</option>
                                                            <option value="SAN MARINO">SAN MARINO</option>
                                                            <option value="SAO TOME AND PRINCIPE">SAO TOME AND PRINCIPE</option>
                                                            <option value="SAUDI ARABIA">SAUDI ARABIA</option>
                                                            <option value="SENEGAL">SENEGAL</option>
                                                            <option value="SERBIA">SERBIA</option>
                                                            <option value="SEYCHELLES">SEYCHELLES</option>
                                                            <option value="SIERRA LEONE">SIERRA LEONE</option>
                                                            <option value="SINGAPORE">SINGAPORE</option>
                                                            <option value="SINT MAARTEN (DUTCH PART)">SINT MAARTEN (DUTCH PART)</option>
                                                            <option value="SLOVAKIA">SLOVAKIA</option>
                                                            <option value="SLOVENIA">SLOVENIA</option>
                                                            <option value="SOLOMON ISLANDS">SOLOMON ISLANDS</option>
                                                            <option value="SOMALIA">SOMALIA</option>
                                                            <option value="SOUTH AFRICA">SOUTH AFRICA</option>
                                                            <option value="SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS">SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS</option>
                                                            <option value="SOUTH SUDAN">SOUTH SUDAN</option>
                                                            <option value="SPAIN">SPAIN</option>
                                                            <option value="SRI LANKA">SRI LANKA</option>
                                                            <option value="SUDAN">SUDAN</option>
                                                            <option value="SURINAME">SURINAME</option>
                                                            <option value="SVALBARD AND JAN MAYEN">SVALBARD AND JAN MAYEN</option>
                                                            <option value="SWAZILAND">SWAZILAND</option>
                                                            <option value="SWEDEN">SWEDEN</option>
                                                            <option value="SWITZERLAND">SWITZERLAND</option>
                                                            <option value="SYRIAN ARAB REPUBLIC">SYRIAN ARAB REPUBLIC</option>
                                                            <option value="TAIWAN, PROVINCE OF CHINA">TAIWAN, PROVINCE OF CHINA</option>
                                                            <option value="TAJIKISTAN">TAJIKISTAN</option>
                                                            <option value="TANZANIA, UNITED REPUBLIC OF">TANZANIA, UNITED REPUBLIC OF</option>
                                                            <option value="THAILAND">THAILAND</option>
                                                            <option value="TIMOR-LESTE">TIMOR-LESTE</option>
                                                            <option value="TOGO">TOGO</option>
                                                            <option value="TOKELAU">TOKELAU</option>
                                                            <option value="TONGA">TONGA</option>
                                                            <option value="TRINIDAD AND TOBAGO">TRINIDAD AND TOBAGO</option>
                                                            <option value="TUNISIA">TUNISIA</option>
                                                            <option value="TURKEY">TURKEY</option>
                                                            <option value="TURKMENISTAN">TURKMENISTAN</option>
                                                            <option value="TURKS AND CAICOS ISLANDS">TURKS AND CAICOS ISLANDS</option>
                                                            <option value="TUVALU">TUVALU</option>
                                                            <option value="UGANDA">UGANDA</option>
                                                            <option value="UKRAINE">UKRAINE</option>
                                                            <option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>
                                                            <option selected="selected" value="UNITED KINGDOM">UNITED KINGDOM</option>
                                                            <option value="UNITED STATES">UNITED STATES</option>
                                                            <option value="UNITED STATES MINOR OUTLYING ISLANDS">UNITED STATES MINOR OUTLYING ISLANDS</option>
                                                            <option value="URUGUAY">URUGUAY</option>
                                                            <option value="UZBEKISTAN">UZBEKISTAN</option>
                                                            <option value="VANUATU">VANUATU</option>
                                                            <option value="VENEZUELA, BOLIVARIAN REPUBLIC OF">VENEZUELA, BOLIVARIAN REPUBLIC OF</option>
                                                            <option value="VIET NAM">VIET NAM</option>
                                                            <option value="VIRGIN ISLANDS, BRITISH">VIRGIN ISLANDS, BRITISH</option>
                                                            <option value="VIRGIN ISLANDS, U.S.">VIRGIN ISLANDS, U.S.</option>
                                                            <option value="WALLIS AND FUTUNA">WALLIS AND FUTUNA</option>
                                                            <option value="WESTERN SAHARA">WESTERN SAHARA</option>
                                                            <option value="YEMEN">YEMEN</option>
                                                            <option value="ZAMBIA">ZAMBIA</option>
                                                            <option value="ZIMBABWE">ZIMBABWE</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Enter password"
                                                               tabindex="1" required data-validation-required-message="Please enter password.">
                                                    </div>

                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="email">Postcode</label>
                                                        <input type="text" name="postcode" class="form-control input-lg" id="postcode" placeholder="Your postcode"
                                                               tabindex="1" required data-validation-required-message="Please enter postcode.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Website address</label>
                                                        <input type="text" name="website_address" class="form-control input-lg" id="website_address" placeholder="Your website address"
                                                               tabindex="1" required data-validation-required-message="Please enter your website address.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Business type</label>
                                                        <select name="business_type" id="business_type" class="form-control input-lg">
                                                            <option value="" selected="selected">&nbsp;</option>
                                                            <option value="LIMITED">LIMITED</option>
                                                            <option value="SOLE TRADER">SOLE TRADER</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company_registration_number">Company registration number</label>
                                                        <input type="text" name="company_registration_number" class="form-control input-lg" id="company_registration_number" placeholder="Your company registration number"
                                                               tabindex="1" required data-validation-required-message="Please enter company registration number.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="vat_registered">VAT Registered</label>
                                                        <select name="vat_registered" id="vat_registered" class="form-control input-lg">
                                                            <option value="Y" selected="selected">YES</option>
                                                            <option value="N">NO</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="trading_years">How long have you been trading? *</label>
                                                        <input type="text" name="trading_years" class="form-control input-lg" id="trading_years" placeholder="How long have you been trading?"
                                                               tabindex="1" required data-validation-required-message="Please enter How long have you been trading?">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="vehicle_parts_deal">What vehicles/parts do you deal in? *</label>
                                                        <input type="text" name="vehicle_parts_deal" class="form-control input-lg" id="vehicle_parts_deal" placeholder="What vehicles/parts do you deal in?"
                                                               tabindex="1" required data-validation-required-message="Please enter What vehicles/parts do you deal in?">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company_registration_number">eBay Account Username</label>
                                                        <input type="text" name="ebay_account_username" class="form-control input-lg" id="ebay_account_username" placeholder="eBay Account Username"
                                                               tabindex="1" required data-validation-required-message="Please enter eBay Account Username.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="about">Where did you hear about us</label>
                                                        <input type="text" name="about" class="form-control input-lg" id="about" placeholder="Your about"
                                                               tabindex="1" required data-validation-required-message="Please enter about.">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-block btn-lg"><i class="ft-user"></i> Register</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
