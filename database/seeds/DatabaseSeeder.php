<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\seeds\v100\SkillsTableSeeder;
use Database\seeds\v100\AttachmentTypeSeeder;
use Database\seeds\v100\InterviewTypesSeeder;
use Database\seeds\v100\TransportMeansSeeder;
use Database\seeds\v100\LeaveTypesTableSeeder;
use Database\seeds\v100\WorkingToolsTableSeeder;
use Database\seeds\v100\SkillCategoryTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(CodesTableSeeder::class);
        $this->call(CodeValuesTableSeeder::class);
        $this->call(DesignationsTableSeeder::class);
        $this->call(UnitGroupsTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(SysdefsTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(ZonesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(InterviewTypesSeeder::class);
//        $this->call(UsersTableSeeder::class);
        $this->call(RequisitionTypesTableSeeder::class);
        $this->call(RequisitionTypeCategoriesTableSeeder::class);
        $this->call(RetirementTypeSeeder::class);
        $this->call(CountryTableSeeder::class);
        // $this->call(CountryOrganisationTableSeeder::class);
        $this->call(FacilityCategoryTableSeeder::class);
        $this->call(FacilityTypeTableSeeder::class);
        $this->call(OwnershipCategoryTableSeeder::class);
        $this->call(OwnershipTableSeeder::class);
        $this->call(LeaveTypesTableSeeder::class);
        $this->call(WorkingToolsTableSeeder::class);
        $this->call(TransportMeansSeeder::class);
        $this->call(AttachmentTypeSeeder::class);
        $this->call(ServicesSeeder::class);
        $this->call(HrHireRequisitionCriteriaTableSeeder::class);


//        $this->call(CountryTableSeeder::class);
//        $this->call(OrganisationTableSeeder::class);
//        $this->call(CountryOrganisationTableSeeder::class);
//        $this->call(FacilityCategoryTableSeeder::class);
//        $this->call(FacilityTypeTableSeeder::class);
//        $this->call(OwnershipCategoryTableSeeder::class);
//        $this->call(OwnershipTableSeeder::class);
//        $this->call(LeaveTypesTableSeeder::class);
//        $this->call(WorkingToolsTableSeeder::class);
//        $this->call(TransportMeansSeeder::class);
//        $this->call(AttachmentTypeSeeder::class);
//        $this->call(ServicesSeeder::class);

        $this->call(WfModuleGroupsTableSeeder::class);
        $this->call(WfModulesTableSeeder::class);
        $this->call(WfDefinitionsTableSeeder::class);
        $this->call(SkillCategoryTableSeeder::class);
        $this->call(SkillsTableSeeder::class);


       $this->call(PrTypesTableSeeder::class);
       $this->call(PrRateScaleTableSeeder::class);
       $this->call(PrCompetenceKeysTableSeeder::class);
       $this->call(PrCompetenceKeyNarrationsTableSeeder::class);
       $this->call(PrAttributesTableSeeder::class);
        DB::commit();
    }
}
