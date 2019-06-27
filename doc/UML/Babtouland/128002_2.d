format 218

classcanvas 128002 class_ref 128002 // Utilisateur
  classdiagramsettings member_max_width 0 end
  xyz 211 72 2000
end
classcanvas 128130 class_ref 128130 // Mot_de_passe
  classdiagramsettings member_max_width 0 end
  xyz 444 288 2000
end
classcanvas 128386 class_ref 128258 // Role
  classdiagramsettings member_max_width 0 end
  xyz 19 266 2000
end
classcanvas 128514 class_ref 128386 // Permission
  classdiagramsettings member_max_width 0 end
  xyz 21 61 2005
end
classcanvas 129026 class_ref 128642 // Manager
  classdiagramsettings member_max_width 0 end
  xyz 663 48 2000
end
classcanvas 129154 class_ref 128770 // Utilisateur_Manager
  classdiagramsettings member_max_width 0 end
  xyz 425 163 2000
end
classcanvas 129922 class_ref 128898 // Mot_de_passe_Manager
  classdiagramsettings member_max_width 0 end
  xyz 645 370 2000
end
classcanvas 130690 class_ref 135426 // Managed
  classdiagramsettings member_max_width 0 end
  xyz 458 536 2000
end
classcanvas 131202 class_ref 135554 // Page
  classdiagramsettings member_max_width 0 end
  xyz 458 662 2000
end
classcanvas 131330 class_ref 135682 // Visiteur
  classdiagramsettings member_max_width 0 end
  xyz 242 719 2000
end
relationcanvas 128258 relation_ref 128002 // <composition>
  from ref 128130 z 2001 to ref 128002
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 128642 relation_ref 128130 // <composition>
  from ref 128514 z 2006 to ref 128386
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 128770 relation_ref 128258 // <directional composition>
  from ref 128386 z 2001 to ref 128002
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 129282 relation_ref 128386 // <association>
  from ref 129154 z 2001 to ref 128002
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 129410 relation_ref 128514 // <dependency>
  from ref 129154 z 2001 to ref 129026
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 130434 relation_ref 128770 // <dependency>
  from ref 129922 z 2001 to ref 129026
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 130562 relation_ref 128898 // <association>
  from ref 128130 z 2001 to ref 129922
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 130946 relation_ref 135554 // <dependency>
  from ref 128002 z 2001 to ref 130690
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 131458 relation_ref 135682 // <realization>
  from ref 131330 z 2001 to ref 128002
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 131586 relation_ref 135810 // <composition>
  from ref 131202 z 2001 to ref 131330
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
end
