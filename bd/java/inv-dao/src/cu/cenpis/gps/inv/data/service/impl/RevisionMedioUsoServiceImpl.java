package cu.cenpis.gps.inv.data.service.impl;

import cu.cenpis.gps.inv.data.dao.RevisionMedioUsoDAO;
import cu.cenpis.gps.inv.data.entity.RevisionMedioUso;
import cu.cenpis.gps.inv.data.service.RevisionMedioUsoService;

import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

@Service
@Transactional
public class RevisionMedioUsoServiceImpl extends BaseServiceImpl<RevisionMedioUso, java.lang.Long, RevisionMedioUsoDAO>
        implements RevisionMedioUsoService {

    public RevisionMedioUsoServiceImpl() {
        System.out.println("RevisionMedioUsoServiceImpl()");
    }
}
