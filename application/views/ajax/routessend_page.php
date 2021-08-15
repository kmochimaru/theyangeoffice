<?php if ($routes_id != null) { ?>
    <select id="def_id_pri" name="def_id_pri_select[]" multiple="multiple">
        <?php
        $orgs = $this->routes_model->getOrganization();
        $routess = $this->routes_model->get_routes_process($routes_id);
        foreach ($routess->result() as $routes) {
            if ($orgs->num_rows() > 0) {
                foreach ($orgs->result() as $org) {
                    $deps = $this->routes_model->getOrgDepartment($org->org_id_pri);
                    if ($deps->num_rows() > 0) {
                        foreach ($deps->result() as $dep) {
                            $dep_offs = $this->routes_model->getdep_off($dep->dep_id_pri);
                            if ($dep_offs->num_rows() > 0) {
                                foreach ($dep_offs->result() as $dep_off) {
                                    if ($routes->dep_off_id == $dep_off->dep_off_id) {
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
        $deps = $this->routes_model->getOrgDepartment($org->org_id_pri);
        if ($deps->num_rows() > 0) {
            foreach ($deps->result() as $dep) {
                $dep_offs = $this->routes_model->getdep_off($dep->dep_id_pri);
                if ($dep_offs->num_rows() > 0) {
                    foreach ($dep_offs->result() as $dep_off) {
                        if ($this->routes_model->check_status($routes_id, $dep_off->dep_off_id) == 0) {
                            ?>
                            <option  value="<?php echo $dep_off->dep_off_id; ?>" data-section="<?php echo $dep->dep_name; ?>" data-index="1"><?php echo $dep_off->officer_name; ?></option>
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
        $orgs = $this->routes_model->getOrganization();
        $deps = $this->routes_model->getOrgDepartment($org->org_id_pri);
        if ($deps->num_rows() > 0) {
            foreach ($deps->result() as $dep) {
                $dep_offs = $this->routes_model->getdep_off($dep->dep_id_pri);
                if ($dep_offs->num_rows() > 0) {
                    foreach ($dep_offs->result() as $dep_off) {
                        ?>
                        <option  value="<?php echo $dep_off->dep_off_id; ?>" data-section="<?php echo $dep->dep_name; ?>" data-index="1"><?php echo $dep_off->officer_name; ?></option>
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