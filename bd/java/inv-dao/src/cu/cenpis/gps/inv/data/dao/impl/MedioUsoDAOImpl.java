package cu.cenpis.gps.inv.data.dao.impl;

import cu.cenpis.gps.inv.data.dao.MedioUsoDAO;
import cu.cenpis.gps.inv.data.entity.MedioUso;
import org.springframework.stereotype.Repository;

@Repository
public class MedioUsoDAOImpl extends AbstractHibernateDAO<MedioUso, java.lang.Long>
        implements MedioUsoDAO {

    public MedioUsoDAOImpl() {
        super(MedioUso.class);
        System.out.println("MedioUsoDAOImpl");
    }

}
