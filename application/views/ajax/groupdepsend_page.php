<?php if ($groupdep_id != null) { ?>
    <select id="def_id_pri" name="def_id_pri_select[]" multiple="multiple">
        <?php
        $orgs = $this->groupdep_model->getOrganization();
        $groupdeps = $this->groupdep_model->get_groupdep_process($groupdep_id);
        foreach ($groupdeps->result() as $groupdep) {
            if ($orgs->num_rows() > 0) {
                foreach ($orgs->result() as $org) {
                    $deps = $this->groupdep_model->getOrgDepartment($org->org_id_pri);
                    if ($deps->num_rows() > 0) {
                        foreach ($deps->result() as $dep) {
                            $dep_offs = $this->groupdep_model->getdep_off($dep->dep_id_pri);
                            if ($dep_offs->num_rows() > 0) {
                                foreach ($dep_offs->result() as $dep_off) {
                                    if ($groupdep->dep_off_id == $dep_off->dep_off_id) {
        ?>
                                        <option selected="" value="<?php echo $dep_off->dep_off_id; ?>" data-section="<?php echo $dep->dep_name; ?>" data-index="1"><?php echo $dep_off->officer_name; ?></option>
                            <?php
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $deps = $this->groupdep_model->getOrgDepartment($org->org_id_pri);
        if ($deps->num_rows() > 0) {
            foreach ($deps->result() as $dep) {
                $dep_offs = $this->groupdep_model->getdep_off($dep->dep_id_pri);
                if ($dep_offs->num_rows() > 0) {
                    foreach ($dep_offs->result() as $dep_off) {
                        if ($this->groupdep_model->check_status($groupdep_id, $dep_off->dep_off_id) == 0) {
                            ?>
                            <option value="<?php echo $dep_off->dep_off_id; ?>" data-section="<?php echo $dep->dep_name; ?>" data-index="1"><?php echo $dep_off->officer_name; ?></option>
        <?php
                        }
                    }
                }
            }
        }
        ?>
    </select>
<?php } else { ?>
    <select id="def_id_pri" name="def_id_pri_select[]" multiple="multiple">
        <?php
        $orgs = $this->groupdep_model->getOrganization();
        $deps = $this->groupdep_model->getOrgDepartment($org->org_id_pri);
        if ($deps->num_rows() > 0) {
            foreach ($deps->result() as $dep) {
                $dep_offs = $this->groupdep_model->getdep_off($dep->dep_id_pri);
                if ($dep_offs->num_rows() > 0) {
                    foreach ($dep_offs->result() as $dep_off) {
                        // เช็คซ้ำ
                        // $check = 0;
                        // if ($this->groupdep_model->checkprocessnotopen($work_info_id_pri, $dep_off->dep_off_id)->num_rows() > 0) {
                        //     $check = 1;
                        // }
                        // if ($dep_off->dep_off_id == $this->session->userdata('dep_off_id')) {
                        //     $check = 1;
                        // }
        ?>
                        <option <?php //echo $check == 1 ? 'readonly' : '' 
                                ?> value="<?php echo $dep_off->dep_off_id; ?>" data-section="<?php echo $dep->dep_name; ?>" data-index="1"><?php echo $dep_off->officer_name; ?></option>
        <?php

                    }
                }
            }
        }
        ?>
    </select>
<?php } ?>
<script>
    $("#def_id_pri").treeMultiselect({
        allowBatchSelection: true,
        enableSelectAll: true,
        searchable: true,
        sortable: true,
        startCollapsed: true,
    });
</script>