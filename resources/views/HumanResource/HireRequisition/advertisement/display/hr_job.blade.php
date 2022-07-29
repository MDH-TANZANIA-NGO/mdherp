

<!-- Section 1 -->
<li class="acc_section">
        <div class="acc_head d-flex justify-content-between">
            <h3> Job Title :  {{$job->title}} | Employees Required: ({{  $job->empoyees_required }})   </h3>
            <span> <a href="#"> View </a> | <a href="{{ route('hirerequisition.edit',$job->uuid) }} ">Edit</a> | <a href="#">Delete</a></span>
           
       
        </div>
        <div class="acc_content" style="display: none;">
            <table class="table table-bordered">
            <thead> 
                <tr>
                    <th colspan="2"  class="text-uppercase">
                        <h5 class="text-uppercase"> Job Title :  {{$job->title}} </h5>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="gray">
                    <td colspan="2" > <h5 class="text-uppercase"> General  Details </h5> </td>
                </tr>
                <tr>
                    <td> <strong>Department: </strong></td>
                    <td> {{ $job->designation }} </td>
                </tr>
                <tr>
                    <td><strong>Number of Employees Required: </strong></td>
                    <td>{{ $job->empoyees_required }}</td>
                </tr>
                <tr>
                    <td><strong>Location: </strong></td>
                    <td> {{ $job->regions }}
                            
                    </td>
                </tr>
                <tr>
                    <td><strong>Date Required : </strong></td>
                    <td>{{ $job->date_required }}</td>
                </tr>
                <tr class="gray">
                    <td colspan="2"> <h5  class="text-uppercase">Person Required  </h5>  </td>
                </tr>
                <tr>
                    <td><strong>Education and Qualification: </strong></td>
                    <td> {!! $job->education_and_qualification !!}</td>
                </tr>
                <tr>
                    
                    <td><strong>Practical Experience: </strong></td>
                    <td> {!! $job->practical_experience !!}</td>
                </tr>
                <tr>
                    <td><strong>Other Special Qualities / Skills: </strong></td>
                    <td>  {!! $job->special_qualities_skills !!} </td>
                </tr>
                <tr class="gray">
                    <td colspan="2"  class="text-uppercase"><h5>  Employement Condition </h5> </td>
                </tr>
                <tr>
                    <td><strong>Contract Type : </strong></td>
                    <td>   {!! $job->contract_type !!} </td>
                </tr>
                <tr>
                    <td><strong>Special Employment Condition : </strong></td>
                    <td>   {!! $job->special_employment_condition !!} </td>
                </tr>
                </tr>
                <tr>
                    <td><strong> Establishment : </strong></td>
                    <td>    {{ $job->establishment }}   </td>
                </tr>
                <tr>
                    <td><strong> Working Tools : </strong></td>
                    <td>   
                        {{ $job->working_tools }}  
                    </td>
                </tr>
                <tr class="gray">
                    <td colspan="2"  class="text-uppercase"><h5> Criteria </h5> </td>
                </tr>
                <tr>
                    
                     
                </tr>
               
                @foreach( $job->hireRequisitionJobCriteria  as $criteria)
                <tr>
                    <td> Education Level </td>
                    <td> {{ $criteria->education_level }}</td>
                </tr>
                <tr>
                    <td> Years Of Experience </td>
                    <td> {{ $criteria->experience_years }}</td>
                </tr>
                <tr>
                    <td> Age</td>
                    <td> {{ $criteria->age }}</td>
                </tr>
              
                @endforeach

               
                <tr>
                    <td> skills</td>
                    <td > 
                        <ul  class="ml-3"style="list-style-type: circle;">
                            @foreach( $job->skills  as $skill)
                                <li> {{ $skill->name }} </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
               
                
            </tbody>
            </table>
  </div>
</li>

  

    
          
 