format 218

classcanvas 128002 class_ref 128642 // Manager
  classdiagramsettings member_max_width 0 end
  xyz 557 162 2000
end
classcanvas 128130 class_ref 135426 // Managed
  classdiagramsettings member_max_width 0 end
  xyz 21 598 2000
end
classcanvas 128258 class_ref 135810 // Post
  classdiagramsettings member_max_width 0 end
  xyz 139 2 2000
end
classcanvas 128642 class_ref 135938 // PostManager
  classdiagramsettings member_max_width 0 end
  xyz 401 277 2000
end
classcanvas 129026 class_ref 136066 // Commentaire
  classdiagramsettings member_max_width 0 end
  xyz 137 658 2000
end
classcanvas 129922 class_ref 136194 // CommentaireManager
  classdiagramsettings member_max_width 0 end
  xyz 547 603 2000
end
relationcanvas 128514 relation_ref 135938 // <realization>
  from ref 128258 z 2001 to ref 128130
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 128770 relation_ref 136066 // <dependency>
  from ref 128642 z 2001 to ref 128002
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 128898 relation_ref 136194 // <association>
  from ref 128258 z 2001 to ref 128642
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 129282 relation_ref 136450 // <composition>
  from ref 129026 z 2001 to ref 128258
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 130050 relation_ref 136578 // <dependency>
  from ref 129922 z 2001 to ref 128002
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 130178 relation_ref 136706 // <association>
  from ref 129922 z 2001 to ref 129026
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 130306 relation_ref 136834 // <dependency>
  from ref 129026 z 2001 to ref 128130
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
end
