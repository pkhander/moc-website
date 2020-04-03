---
ID: 1413
post_title: Open Cloud Testbed(OCT)
author: pkhander@redhat.com
post_excerpt: ""
layout: page
permalink: >
  https://stagemoc.com/open-cloud-testbedoct/
published: true
post_date: 2020-03-09 16:08:48
---
<!-- wp:heading -->
<h2><strong>Overview</strong></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"medium"} -->
<p class="has-medium-font-size">The NSF “Open Cloud Testbed” (OCT) project will build and support a testbed for research and experimentation into new cloud platforms – the underlying software which provides cloud services to applications. Testbeds such as OCT are critical for enabling research into new cloud technologies – research that requires experiments which potentially change the operation of the cloud itself. </p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator"/>
<!-- /wp:separator -->

<!-- wp:paragraph {"align":"center","fontSize":"medium"} -->
<p class="has-text-align-center has-medium-font-size">The new testbed will:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>Combine proven software technologies from both the <a rel="noreferrer noopener" href="https://www.cloudlab.us/" target="_blank">CloudLab</a> and the <a rel="noreferrer noopener" href="https://massopen.cloud" target="_blank">Mass Open Cloud</a> projects</li><li>Combine a research cloud testbed with a production cloud, through OCT’s tight integration with MOC</li><li>Federate with CloudLab</li><li>Provide programmable hardware (FPGAs) capabilities not present in other facilities available to researchers today</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph {"align":"center","fontSize":"medium"} -->
<p class="has-text-align-center has-medium-font-size">The combination of a testbed and production cloud allows:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>Larger scale compared to isolated testbeds</li><li>Reproducible experimentation based on realistic user behavior and applications</li><li>A model for transitioning successful research results to practice</li></ul>
<!-- /wp:list -->

<!-- wp:separator -->
<hr class="wp-block-separator"/>
<!-- /wp:separator -->

<!-- wp:paragraph {"fontSize":"medium"} -->
<p class="has-medium-font-size">The programmable hardware will be a unique resource enabling investigation into hardware acceleration techniques, research not possible on testbeds available to cloud researchers today, and the community outreach portion of the project aims to identify, attract, and retain these researchers, and to educate them in the use of the facility. The testbed offers a unique sustainability model, by allowing additional compute resources to be dynamically moved from institutional uses into the testbed and back again, providing a path to growth beyond the initial testbed. This testbed will accelerate innovation in cloud technologies; technologies affecting almost all of computing today. In providing capabilities that today are only available to researchers within a few large commercial cloud providers, it will allow diverse communities to exploit these technologies, “democratizing” cloud computing research, and allowing increased collaboration between the research and open source communities. The community outreach activities of the project are targeted to researchers who explore complex distributed systems and cloud platforms, spanning a diverse range of backgrounds, institutions, and regions. Software tools will be developed to provide easy and efficient access by these researchers; tutorials, workshops, and webinars will offer training in the use of these tools and the testbed itself. The project will support educating the next generation of researchers in this field, and existing relationships with industrial partners of the MOC will accelerate technology transfer from academic research to practical use. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"medium"} -->
<p class="has-medium-font-size">Today’s cloud testbeds have become a critical tool for systems researchers; providing researchers access to large scale raw hardware, support for reproducible experiments, and automation for deploying complex environments. For example, in just the last three years nearly 3,400 researchers have used the CloudLab testbed to conduct over 70,000 experiment and have published results in many top-level research venues, including SIGCOMM, OSDI, SOSP, NSDI, and FAST. Unfortunately, today’s testbeds are isolated in that they are deployed using dedicated infrastructure and are made available to a specific community of researchers for which funding (e.g. from the NSF) was obtained. This isolation results in a number of problems. First, with fixed resources and a community with similar deadlines (e.g. important academic conferences) it is difficult to efficiently handle peak demand. Second, limiting the use of the testbed to a specific community limits the community enhancing and extending the testbed; testbed capabilities could have enormous value for a broad industry and open source community. Third, the testbed is isolated from production environments; meaning that the testbed has no direct way to provide researchers using it access to production information, real datasets and real users, which in turn limits the ability of these researchers to pursue certain research efforts. Finally, the combination of these challenges introduces barriers to another research goal, that of transitioning research developed in the testbed to practice.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"medium"} -->
<p class="has-medium-font-size">We propose creating the Open Cloud Testbed (OCT) that will addresses the challenges inherent in an isolated testbed by integrating testbed capabilities into the Mass Open Cloud (MOC), an existing cloud for academic users. In particular, we propose to 1) add testbed dedicated resources, including a cluster of FPGA enhanced nodes, in the MGHPCC data center used by the MOC, 2) harden the MOC’s Elastic Secure Infrastructure (ESI) mechanism, which allows physical servers to be elastically and securely moved between different services, 3) integrate ESI with CloudLab’s provisioning mechanisms, and 4) provide system researchers access to cloud telemetry and datasets and provide them with the ability to expose experimental services to users of the MOC.</p>
<!-- /wp:paragraph -->