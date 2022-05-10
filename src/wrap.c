#include <linux/seccomp.h>
#include <sys/resource.h>
#include <seccomp.h>
#include <sys/prctl.h>

/** Scop: execvp(3), flaf **/
#include <unistd.h>
#include <fcntl.h>

/** Scop: boolean **/
#include <stdbool.h>

int i, oo;

int
main(int argc, char *argv[])
{
  /* tot in whitelist */
  scmp_filter_ctx filtru = seccomp_init(SCMP_ACT_ALLOW);


  int blocare[] = {
    /** blocare retea **/  /** threading **/  /** fisiere baza **/
    SCMP_SYS(socket),      SCMP_SYS(kill),    SCMP_SYS(unlink),
    SCMP_SYS(socketpair),  SCMP_SYS(fork),    SCMP_SYS(unlinkat),
    SCMP_SYS(getsockopt),  SCMP_SYS(vfork),   SCMP_SYS(open),
    SCMP_SYS(getsockname), SCMP_SYS(clone),   SCMP_SYS(fstat),
    SCMP_SYS(getpeername),                    SCMP_SYS(stat),
    SCMP_SYS(bind),
    SCMP_SYS(listen),
    SCMP_SYS(accept),
    SCMP_SYS(accept4),
    SCMP_SYS(connect),
    SCMP_SYS(shutdown)
  };

  oo = sizeof(blocare) / sizeof(int);
  for (; i < oo; ++i) {
    seccomp_rule_add(filtru, SCMP_ACT_KILL, blocare[i], false);
  }

  /* open(2) w/rw */
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(openat), true,
      SCMP_CMP(2, SCMP_CMP_MASKED_EQ,O_WRONLY,O_WRONLY));

  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(openat), true, 
      SCMP_CMP(2,SCMP_CMP_MASKED_EQ,O_RDWR,O_RDWR));
  
  alarm(3);

  seccomp_load(filtru);
  execvp(argv[1], &argv[1]);
  seccomp_release(filtru);
}
