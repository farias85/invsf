package cu.cenpis.gps.inv.data.dao.impl;

import cu.cenpis.gps.inv.data.dao.MetadataMedioUsoDAO;
import cu.cenpis.gps.inv.data.entity.MetadataMedioUso;
import org.springframework.stereotype.Repository;

@Repository
public class MetadataMedioUsoDAOImpl extends AbstractHibernateDAO<MetadataMedioUso, java.lang.Long>
        implements MetadataMedioUsoDAO {

    public MetadataMedioUsoDAOImpl() {
        super(MetadataMedioUso.class);
        System.out.println("MetadataMedioUsoDAOImpl");
    }

}
