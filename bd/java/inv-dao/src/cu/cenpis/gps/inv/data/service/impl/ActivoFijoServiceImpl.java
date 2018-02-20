package cu.cenpis.gps.inv.data.service.impl;

import cu.cenpis.gps.inv.data.service.ActivoFijoService;
import cu.cenpis.gps.inv.data.entity.ActivoFijo;
import cu.cenpis.gps.inv.data.dao.ActivoFijoDAO;
import java.util.List;

import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

@Service
@Transactional
public class ActivoFijoServiceImpl extends BaseServiceImpl<ActivoFijo, java.lang.Long, ActivoFijoDAO>
        implements ActivoFijoService {

    public ActivoFijoServiceImpl() {
        System.out.println("ActivoFijoServiceImpl()");
    }

    @Override
    public List<ActivoFijo> findByMultipleRotulos(List<String> rList) {
        return dao.findByMultipleRotulos(rList);
    }

    @Override
    public List<ActivoFijo> findYaNoEstan() {
        return dao.findYaNoEstan();
    }

    @Override
    public List<ActivoFijo> findNuevos() {
        return dao.findNuevos();
    }
}
