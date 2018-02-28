package cu.cenpis.gps.inv.data.dao.impl;

import cu.cenpis.gps.inv.data.dao.RevisionMedioUsoDAO;
import cu.cenpis.gps.inv.data.entity.RevisionMedioUso;
import org.springframework.stereotype.Repository;

@Repository
public class RevisionMedioUsoDAOImpl extends AbstractHibernateDAO<RevisionMedioUso, java.lang.Long>
        implements RevisionMedioUsoDAO {

    public RevisionMedioUsoDAOImpl() {
        super(RevisionMedioUso.class);
        System.out.println("RevisionMedioUsoDAOImpl");
    }
}
