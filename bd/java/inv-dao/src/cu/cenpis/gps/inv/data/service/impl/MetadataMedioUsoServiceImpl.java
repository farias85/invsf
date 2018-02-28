package cu.cenpis.gps.inv.data.service.impl;

import cu.cenpis.gps.inv.data.dao.MetadataMedioUsoDAO;
import cu.cenpis.gps.inv.data.entity.MetadataMedioUso;
import cu.cenpis.gps.inv.data.service.MetadataMedioUsoService;

import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

@Service
@Transactional
public class MetadataMedioUsoServiceImpl extends BaseServiceImpl<MetadataMedioUso, java.lang.Long, MetadataMedioUsoDAO>
        implements MetadataMedioUsoService {

    public MetadataMedioUsoServiceImpl() {
        System.out.println("MedatadaMedioUsoServiceImpl()");
    }
}
