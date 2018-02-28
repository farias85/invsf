package cu.cenpis.gps.inv.data.service.impl;

import cu.cenpis.gps.inv.data.dao.MedioUsoDAO;
import cu.cenpis.gps.inv.data.entity.MedioUso;
import cu.cenpis.gps.inv.data.service.MedioUsoService;

import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

@Service
@Transactional
public class MedioUsoServiceImpl extends BaseServiceImpl<MedioUso, java.lang.Long, MedioUsoDAO>
        implements MedioUsoService {

    public MedioUsoServiceImpl() {
        System.out.println("MedioUsoServiceImpl()");
    }
}
